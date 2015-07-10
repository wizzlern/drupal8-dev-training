<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Controller\DisplayController.
 */

namespace Drupal\wizzlern_webservice\Controller;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\wizzlern_webservice\ClientApi\HtmlClientApi;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DisplayController.
 *
 * @package Drupal\wizzlern_webservice\Controller
 */
class DisplayController extends ControllerBase {

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
  protected $htmlProcessorPluginManager;

  /**
   * Constructs a new DisplayController instance.
   *
   * @param \Drupal\wizzlern_webservice\ClientApi\HtmlClientApi $html_client_api
   *   The HTML client webservice.
   * @param \Drupal\Component\Plugin\PluginManagerInterface $html_processor_plugin_manager
   *   The HTML Processor plugin manager.
   */
  public function __construct(HtmlClientApi $html_client_api, PluginManagerInterface $html_processor_plugin_manager) {
    $this->htmlClientApi = $html_client_api;
    $this->htmlProcessorPluginManager = $html_processor_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('wizzlern_webservice.html_client'),
      $container->get('plugin.manager.html_client.processor')
    );
  }

  /**
   * Page controller: Displays data received via the webservice.
   *
   * @return array
   *   Render array page output.
   */
  public function receivedData() {

    $items = array();

    /** @var \Drupal\wizzlern_webservice\Entity\HtmlClient[] $entities */
    $entities = $this->entityManager()->getStorage('html_client')->loadMultiple();
    foreach ($entities as $entity) {

      // Load HTML data from the endpoint.
      try {
        $dom = $this->htmlClientApi->loadDom($entity->getEndpointUrl());
      }
      catch (\Exception $e) {
        watchdog_exception('wizzlern_webservice', $e);
        drupal_set_message($this->t('Failed to find data at %name.', array('%name' => $entity->label())), 'error');
        break;
      }

      // Execute processor plugins on the HTML data.
      foreach ($entity->getProcessors() as $plugin_id) {

        // Load and execute HTML processor plugin.
        /** @var \Drupal\wizzlern_webservice\HtmlProcessorInterface $processor */
        $processor = $this->htmlProcessorPluginManager->createInstance($plugin_id);
        $result = $processor->setDom($dom)->process();
        if ($result) {
          $items[] = $this->t('@label of %name: @result', array(
            '@label' => $processor->getName(),
            '%name' => $entity->label(),
            '@result' => $result,
          ));
        }
        else {
          $items[] = $this->t('No @label found for %name', array(
            '@label' => $processor->getName(),
            '%name' => $entity->label(),
          ));
        }
      }
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
    ];
  }

}
