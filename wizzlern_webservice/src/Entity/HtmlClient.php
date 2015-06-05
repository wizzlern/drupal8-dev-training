<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Entity\HtmlClient.
 */

namespace Drupal\wizzlern_webservice\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\wizzlern_webservice\HtmlClientInterface;

/**
 * Defines the HtmlClient entity.
 *
 * @ConfigEntityType(
 *   id = "html_client",
 *   label = @Translation("HTML webservice client"),
 *   handlers = {
 *     "list_builder" = "Drupal\wizzlern_webservice\Controller\HtmlClientListBuilder",
 *     "form" = {
 *       "add" = "Drupal\wizzlern_webservice\Form\HtmlClientForm",
 *       "edit" = "Drupal\wizzlern_webservice\Form\HtmlClientForm",
 *       "delete" = "Drupal\wizzlern_webservice\Form\HtmlClientDeleteForm"
 *     }
 *   },
 *   config_prefix = "html_client",
 *   admin_permission = "administer wizzlern webservice",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/services/wizzlern_webservice/{html_client}",
 *     "delete-form" = "/admin/config/services/wizzlern_webservice/{html_client}/delete",
 *     "collection" = "/admin/config/services/wizzlern_webservice"
 *   }
 * )
 */
class HtmlClient extends ConfigEntityBase implements HtmlClientInterface {

  use StringTranslationTrait;

  /**
   * The HTML Client ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The HTML Client label.
   *
   * @var string
   */
  protected $label;

  /**
   * The endpoint URL.
   *
   * @var string
   */
  protected $endpoint_url;

  /**
   * Data processors.
   *
   * @var array
   */
  protected $processors = array();


  protected $html_processor;

  /**
   * {@inheritdoc}
   */
  function getEndpointUrl() {
    return $this->endpoint_url;
  }


  /**
   * {@inheritdoc}
   */
  function getAllProcessors() {
    $options = array();

    $processors = \Drupal::getContainer()->get('plugin.manager.html_client.processor')->getDefinitions();

    foreach ($processors as $processor => $definition) {
      $options[$processor] = $definition['label']->render();
    }
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  function getProcessors() {
    return array_filter($this->processors);
  }
}
