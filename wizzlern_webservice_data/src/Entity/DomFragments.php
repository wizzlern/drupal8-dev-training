<?php

namespace Drupal\wizzlern_webservice\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\wizzlern_webservice\DomFragmentsInterface;

/**
 * Defines the DomFragments entity.
 *
 * @ingroup wizzlern_webservice
 *
 * @ContentEntityType(
 *   id = "dom_fragments",
 *   label = @Translation("DomFragments entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\wizzlern_webservice\Entity\Controller\DomFragmentsListController",
 *     "views_data" = "Drupal\wizzlern_webservice\Entity\DomFragmentsViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\wizzlern_webservice\Entity\Form\DomFragmentsForm",
 *       "add" = "Drupal\wizzlern_webservice\Entity\Form\DomFragmentsForm",
 *       "edit" = "Drupal\wizzlern_webservice\Entity\Form\DomFragmentsForm",
 *       "delete" = "Drupal\wizzlern_webservice\Entity\Form\DomFragmentsDeleteForm",
 *     },
 *     "access" = "Drupal\wizzlern_webservice\DomFragmentsAccessControlHandler",
 *   },
 *   base_table = "dom_fragments",
 *   admin_permission = "administer DomFragments entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/entity.dom_fragments.canonical",
 *     "edit-form" = "/entity.dom_fragments.edit_form",
 *     "delete-form" = "/entity.dom_fragments.delete_form",
 *     "collection" = "/entity.dom_fragments.collection"
 *   },
 *   field_ui_base_route = "dom_fragments.settings"
 * )
 */
class DomFragments extends ContentEntityBase implements DomFragmentsInterface {

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function isTranslatable() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the DomFragments entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the DomFragments entity.'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the DomFragments entity.'))
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 0,
      ))
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['html_generator'] = BaseFieldDefinition::create('string')
      ->setLabel(t('HTML Generator'))
      ->setDescription(t('The software that generated the HTML.'))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => 1,
      ))
      ->setDisplayConfigurable('view', TRUE);

    $fields['html_language'] = BaseFieldDefinition::create('string')
      ->setLabel(t('HTML Language'))
      ->setDescription(t('The language of the HTML.'))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => 2,
      ))
      ->setDisplayConfigurable('view', TRUE);

    $fields['html_h1'] = BaseFieldDefinition::create('string')
      ->setLabel(t('HTML H1'))
      ->setDescription(t('The content of the H1 tag.'))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => 3,
      ))
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
