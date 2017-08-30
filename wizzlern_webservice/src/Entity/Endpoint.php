<?php

namespace Drupal\wizzlern_webservice\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\wizzlern_webservice\EndpointInterface;

/**
 * Defines the Endpoint entity.
 *
 * @ConfigEntityType(
 *   id = "endpoint",
 *   label = @Translation("HTML eindpoint"),
 *   handlers = {
 *     "list_builder" = "Drupal\wizzlern_webservice\Controller\EndpointListBuilder",
 *     "form" = {
 *       "add" = "Drupal\wizzlern_webservice\Form\EndpointForm",
 *       "edit" = "Drupal\wizzlern_webservice\Form\EndpointForm",
 *       "delete" = "Drupal\wizzlern_webservice\Form\EndpointDeleteForm"
 *     }
 *   },
 *   config_prefix = "endpoint",
 *   admin_permission = "administer wizzlern webservice",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/services/wizzlern_webservice/{endpoint}",
 *     "delete-form" = "/admin/config/services/wizzlern_webservice/{endpoint}/delete",
 *     "collection" = "/admin/config/services/wizzlern_webservice"
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
