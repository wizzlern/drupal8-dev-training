<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Form\ImportDomElementsForm.
 */

namespace Drupal\wizzlern_webservice\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\wizzlern_webservice\HtmlLoader\HtmlLoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ImportDomElementsForm.
 *
 * @package Drupal\wizzlern_webservice\Form
 */
class ImportDomElementsForm extends FormBase {

  /**
   * The HTML loader service.
   *
   * @var \Drupal\wizzlern_webservice\HtmlLoader\HtmlLoaderInterface
   */
  protected $htmlLoader;

  /**
   * The HTML processor plugin manager.
   *
   * @var \Drupal\wizzlern_webservice\HtmlProcessorManager
   */
  protected $htmlProcessorManager;

  /**
   * Constructs a new Dom Elements import form.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The rules_component storage.
   */
  public function __construct(HtmlLoaderInterface $html_loader, HtmlProcessorInterface $html_processor_manager) {
    $this->htmlLoader = $html_loader;
    $this->htmlProcessorManager = $html_processor_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wizzlern_webservice.html_loader'),
      $container->get('plugin.manager.html_processor')
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
    // @todo Change architecture. Make service? Redirect to wizzlern_webservice.html_client.data?
    $entities = \Drupal::entityManager()->getStorage('html_client')->loadMultiple();
    foreach ($entities as $entity) {

      // Load HTML data from the endpoint.
      try {
        $dom = $this->htmlLoader->loadDom($entity->getEndpointUrl());
      }
      catch (\Exception $e) {
        watchdog_exception('wizzlern_webservice', $e);
        drupal_set_message($this->t('Failed to find data at %name.', array('%name' => $entity->label())), 'error');
        break;
      }

      // Execute processor plugins on the HTML data.
      foreach ($entity->getProcessors() as $plugin_id) {
        $result = NULL;

        // Load and execute HTML processor plugin.
        /** @var \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlH1Processor $processor */
        $processor = $this->htmlProcessorManager->createInstance($plugin_id);
        if ($dom = $processor->setDom($dom)) {
          $result = $dom->process();
        }

        if ($result) {
          $key = $processor->getId();
          $values[$key] = $result;
        }
      }

      \Drupal::entityManager()->getStorage('dom_elements')
        ->create($values)
        ->save();

    }
  }
}
