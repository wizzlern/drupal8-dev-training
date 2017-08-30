<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Entity\Endpoint.
 */

namespace Drupal\wizzlern_webservice\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\wizzlern_webservice\EndpointInterface;

/**
 * Defines the Endpoint entity.
 *
 * @ConfigEntityType(
 *   id = "endpoint",
 *   label = @Translation("Endpoint"),
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

  /**
   * The Endpoint ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Endpoint label.
   *
   * @var string
   */
  protected $label;

}
