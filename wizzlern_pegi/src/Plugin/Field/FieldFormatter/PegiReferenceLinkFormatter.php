<?php

namespace Drupal\wizzlern_pegi\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
class PegiReferenceLinkFormatter extends EntityReferenceFormatterBase implements ContainerFactoryPluginInterface {


  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a PegiReferenceLinkFormatter instance.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings settings.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'image_style' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $image_styles = image_style_options(FALSE);
    $element['image_style'] = [
      '#title' => t('Image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('image_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $image_styles = image_style_options(FALSE);
    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    $image_style_setting = $this->getSetting('image_style');
    if (isset($image_styles[$image_style_setting])) {
      $summary[] = t('Image style: @style', ['@style' => $image_styles[$image_style_setting]]);
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
    $elements = [];

    foreach ($this->getEntitiesToView($items, $langcode) as $delta => $entity) {
      /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem $image */
      // We assume that only one image is used.
      $item = $entity->{WIZZLERN_PEGI_TERM_IMAGE_FIELD}[0];
      $image_style = $this->getSetting('image_style');

      // Collect cache tags to be added for each item in the field.
      $cache_tags = [];
      if (!empty($image_style_setting)) {
        /** @var \Drupal\image\Entity\ImageStyle $image_style_entity */
        $image_style_entity = $this->entityTypeManager
          ->getStorage('image_style')
          ->load($image_style);
        $cache_tags = $image_style_entity->getCacheTags();
      }

      if (isset($image_style)) {
        $image = [
          '#theme' => 'image_formatter',
          '#item' => $item,
          '#image_style' => $this->getSetting('image_style'),
          '#cache' => [
            'tags' => $cache_tags,
          ],
        ];

        $elements[] = [
          '#type' => 'inline_template',
          '#template' => '{{ image }}<span class="pegi-link-all">{{ link }}</span>',
          '#context' => [
            'image' => $image,
            'link' => $entity->toLink($this->t('All games with this rating')),
          ],
        ];
      }
    }

    return $elements;
  }

}
