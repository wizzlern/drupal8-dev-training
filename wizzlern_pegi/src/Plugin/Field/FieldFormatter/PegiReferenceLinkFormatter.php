<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Field\FieldFormatter\PegiReferenceLinkFormatter.
 */

namespace Drupal\wizzlern_pegi\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'entity reference label' formatter.
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
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();

    foreach ($this->getEntitiesToView($items) as $delta => $entity) {
      /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem $image */
      $item = $entity->field_pegi_label[0]; // Hardcoded: field name, one image only.
      $url = $entity->url();
      $image_style_setting = $this->getSetting('image_style');

      // Collect cache tags to be added for each item in the field.
      $cache_tags = array();
      if (!empty($image_style_setting)) {
        $image_style = entity_load('image_style', $image_style_setting);
        $cache_tags = $image_style->getCacheTags();
      }

      $image = array(
        '#theme' => 'image_formatter',
        '#item' => $item,
        '#image_style' => $image_style_setting,
        '#cache' => array(
          'tags' => $cache_tags,
        ),
      );
      $link = array(
        '#type' => 'link',
        '#title' => $this->t('All games with this rating'),
        '#url' => Url::fromUserInput($url),
      );
      $elements[] = array(
        '#type' => 'inline_template',
        '#template' => '{{ image }}<span class="pegi-link-all">{{ link }}</span>',
        '#context' => array(
          'image' => $image,
          'link' => $link,
        ),
      );
    }

    return $elements;
  }

}
