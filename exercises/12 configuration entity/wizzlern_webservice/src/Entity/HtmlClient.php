<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Entity\HtmlClient.
 */

namespace Drupal\wizzlern_webservice\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\wizzlern_webservice\HtmlClientInterface;

/**
 * Defines the HtmlClient entity.
 *
 * @ConfigEntityType(
 *   id = "html_client",
 *   label = @Translation("HtmlClient"),
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
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "endpoint_url",
 *     "processors"
 *   }
 * )
 */
class HtmlClient extends ConfigEntityBase implements HtmlClientInterface {

  /**
   * The HtmlClient ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The HtmlClient label.
   *
   * @var string
   */
  protected $label;

}
