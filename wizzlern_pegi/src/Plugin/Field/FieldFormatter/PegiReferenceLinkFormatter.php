<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Field\FieldFormatter\PegiReferenceLinkFormatter.
 */

namespace Drupal\wizzlern_pegi\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;

/**
 * Plugin implementation of the 'pegi reference label' formatter.
 *
 * @FieldFormatter(
 *   id = "wizzlern_pegi_reference_link",
 *   label = @Translation("Pegi icon with link"),
 *   description = @Translation("Display the Pegi icon with a 'view all' link."),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class PegiReferenceLinkFormatter extends EntityReferenceFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'image_style' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $image_styles = image_style_options(FALSE);
    $element['image_style'] = array(
      '#title' => t('Image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('image_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
    );

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $image_styles = image_style_options(FALSE);
    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    $image_style_setting = $this->getSetting('image_style');
    if (isset($image_styles[$image_style_setting])) {
      $summary[] = t('Image style: @style', array('@style' => $image_styles[$image_style_setting]));
    }
    else {
      $summary[] = t('Original image');
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
      /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem $image */
      // We assume that only one image is used.
      $item = $entity->{WIZZLERN_PEGI_FIELD_PEGI_LABEL}[0];
      $image_style = $this->getSetting('image_style');

      // Collect cache tags to be added for each item in the field.
      $cache_tags = array();
      if (!empty($image_style_setting)) {
        /** @var \Drupal\image\Entity\ImageStyle $image_style_entity */
        // @todo Use DI for this service.
        $image_style_entity = \Drupal::getContainer()
          ->get('entity_type.manager')
          ->getStorage('image_style')
          ->load($image_style);
        $cache_tags = $image_style_entity->getCacheTags();
      }

      if (isset($image_style)) {
        $image = array(
          '#theme' => 'image_formatter',
          '#item' => $item,
          '#image_style' => $this->getSetting('image_style'),
          '#cache' => array(
            'tags' => $cache_tags,
          ),
        );

        $elements[] = array(
          '#type' => 'inline_template',
          '#template' => '{{ image }}<span class="pegi-link-all">{{ link }}</span>',
          '#context' => array(
            'image' => $image,
            'link' => $entity->toLink($this->t('All games with this rating')),
          ),
        );
      }
    }

    return $elements;
  }

}
