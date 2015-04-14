<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Controller\DefaultController.
 */

namespace Drupal\wizzlern_webservice\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\wizzlern_webservice\ClientApi\HtmlClientApi;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DefaultController.
 *
 * @package Drupal\wizzlern_webservice\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * HTML Client API.
   *
   * @var \Drupal\wizzlern_webservice\ClientApi\HtmlClientApi
   */
  protected $htmlClientApi;

  /**
   * HTML processor plugin manager.
   *
   * @var \Drupal\wizzlern_webservice\HtmlProcessorBase
   */
  protected $html_processor_plugin_manager;

  /**
   * Constructs a new BlockController instance.
   *
   * @param \Drupal\Core\Extension\ThemeHandlerInterface $theme_handler
   *   The theme handler.
   */
  public function __construct(HtmlClientApi $html_client_api, $html_processor_plugin_manager) {
    $this->htmlClientApi = $html_client_api;
    $this->html_processor_plugin_manager = $html_processor_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wizzlern_webservice.html_client'),
      $container->get('plugin.manager.html_client.html_processor')
    );
  }

  /**
   * Page controller: Displays data received via the webservice.
   *
   * @return array
   *   Render array page output.
   */
  public function ReceivedData() {

    $items = array();

    /** @var \Drupal\wizzlern_webservice\Entity\WizzlernWebservice[] $entities */
    $entities = $this->entityManager()->getStorage('html_client')->loadMultiple();
    foreach($entities as $entity) {

      try {
        $dom = $this->htmlClientApi->loadDom($entity->getEndpointUrl());
      }
      catch (\Exception $e) {
        watchdog_exception('wizzlern_webservice', $e);
        drupal_set_message($this->t('Failed to find data at %name.', array('%name' => $entity->label())), 'error');
        break;
      }

      foreach ($entity->getProcessors() as $plugin_id) {

        // Load and execute HTML processor plugin.
        /** @var \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlH1Processor $processor */
        $processor = $this->html_processor_plugin_manager->createInstance($plugin_id);
        $result = $processor->setDom($dom)->process();
        if ($result) {
          $items[] = $this->t('@label of %name: @result', array('@label' => $processor->getName(), '%name' => $entity->label(), '@result' => $result));
        }
        else {
          $items[] = $this->t('No @label found for %name', array('@label' => $processor->getName(), '%name' => $entity->label()));
        }
      }
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
    ];
  }

}
