<?php

namespace Drupal\wizzlern_crawler\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\wizzlern_crawler\HtmlLoader\HtmlLoaderInterface;
use Drupal\wizzlern_crawler\HtmlProcessorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ImportDomElementsForm.
 *
 * @package Drupal\wizzlern_crawler\Form
 */
class ImportDomElementsForm extends FormBase {

  /**
   * The HTML loader service.
   *
   * @var \Drupal\wizzlern_crawler\HtmlLoader\HtmlLoaderInterface
   */
  protected $htmlLoader;

  /**
   * The HTML processor plugin manager.
   *
   * @var \Drupal\wizzlern_crawler\HtmlProcessorManager
   */
  protected $htmlProcessorManager;

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new Dom Elements import form.
   *
   * @param \Drupal\wizzlern_crawler\HtmlLoader\HtmlLoaderInterface $html_loader
   *   The HML loader.
   * @param \Drupal\wizzlern_crawler\HtmlProcessorInterface $html_processor_manager
   *   The HTML processor manager.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(HtmlLoaderInterface $html_loader, HtmlProcessorInterface $html_processor_manager, EntityTypeManagerInterface $entity_type_manager) {
    $this->htmlLoader = $html_loader;
    $this->htmlProcessorManager = $html_processor_manager;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wizzlern_crawler.html_loader'),
      $container->get('plugin.manager.html_processor'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'import_dom_elements';
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $build['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Import'),
    ];

    return $build;
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = [];
    // @todo Change architecture. Make service? Use protected function?
    // @todo Redirect to wizzlern_crawler.endpoint.data?
    /** @var \Drupal\wizzlern_crawler\Entity\Endpoint[] $entities */
    $entities = $this->entityTypeManager->getStorage('endpoint')->loadMultiple();
    foreach ($entities as $entity) {

      // Load HTML data from the endpoint.
      try {
        $dom = $this->htmlLoader->loadDom($entity->getUrl());
      }
      catch (\Exception $e) {
        watchdog_exception('wizzlern_crawler', $e);
        drupal_set_message($this->t('Failed to find data at %name.', ['%name' => $entity->label()]), 'error');
        break;
      }

      // Execute processor plugins on the HTML data.
      foreach ($entity->getConfiguredProcessors() as $plugin_id) {
        $result = NULL;

        // Load and execute HTML processor plugin.
        /** @var \Drupal\wizzlern_crawler\Plugin\HtmlProcessor\HtmlH1Processor $processor */
        $processor = $this->htmlProcessorManager->createInstance($plugin_id);
        if ($dom = $processor->setDom($dom)) {
          $result = $dom->process();
        }

        if ($result) {
          $key = $processor->getId();
          $values[$key] = $result;
        }
      }

      if ($values) {
        $this->entityTypeManager->getStorage('dom_elements')
          ->create($values)
          ->save();
      }
    }
  }

}
