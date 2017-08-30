<?php

namespace Drupal\wizzlern_crawler\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\wizzlern_crawler\EndpointInterface;

/**
 * Defines the Endpoint entity.
 *
 * @ConfigEntityType(
 *   id = "endpoint",
 *   label = @Translation("HTML endpoint"),
 *   handlers = {
 *     "list_builder" = "Drupal\wizzlern_crawler\Controller\EndpointListBuilder",
 *     "form" = {
 *       "add" = "Drupal\wizzlern_crawler\Form\EndpointForm",
 *       "edit" = "Drupal\wizzlern_crawler\Form\EndpointForm",
 *       "delete" = "Drupal\wizzlern_crawler\Form\EndpointDeleteForm"
 *     }
 *   },
 *   config_prefix = "endpoint",
 *   admin_permission = "administer wizzlern crawler endpoint",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/services/wizzlern_crawler/{endpoint}",
 *     "delete-form" = "/admin/config/services/wizzlern_crawler/{endpoint}/delete",
 *     "collection" = "/admin/config/services/wizzlern_crawler"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "endpoint_url",
 *     "processors"
 *   }
 * )
 */
class Endpoint extends ConfigEntityBase implements EndpointInterface {

  use StringTranslationTrait;

  /**
   * The HTML endpoint ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The HTML endpoint label.
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
  protected $processors = [];

  /**
   * {@inheritdoc}
   */
  public function getUrl() {
    return $this->endpoint_url;
  }

  /**
   * {@inheritdoc}
   */
  public function getAllProcessors() {
    $options = [];

    $processors = \Drupal::getContainer()->get('plugin.manager.html_processor')->getDefinitions();

    foreach ($processors as $processor => $definition) {
      $options[$processor] = $definition['label']->render();
    }
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguredProcessors() {
    return array_filter($this->processors);
  }

}
