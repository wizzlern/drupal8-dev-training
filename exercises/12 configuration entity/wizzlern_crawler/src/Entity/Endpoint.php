<?php

namespace Drupal\wizzlern_crawler\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Endpoint entity.
 *
 * @ConfigEntityType(
 *   id = "endpoint",
 *   label = @Translation("Endpoint"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\wizzlern_crawler\EndpointListBuilder",
 *     "form" = {
 *       "add" = "Drupal\wizzlern_crawler\Form\EndpointForm",
 *       "edit" = "Drupal\wizzlern_crawler\Form\EndpointForm",
 *       "delete" = "Drupal\wizzlern_crawler\Form\EndpointDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\wizzlern_crawler\EndpointHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "endpoint",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/endpoint/{endpoint}",
 *     "add-form" = "/admin/config/endpoint/add",
 *     "edit-form" = "/admin/config/endpoint/{endpoint}/edit",
 *     "delete-form" = "/admin/config/endpoint/{endpoint}/delete",
 *     "collection" = "/admin/config/endpoint"
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
