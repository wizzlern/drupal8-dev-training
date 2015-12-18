<?php
/**
 * @file
 * Contains \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlLanguageProcessor.
 */

namespace Drupal\wizzlern_webservice\Plugin\HtmlProcessor;

use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\wizzlern_webservice\HtmlProcessorBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an HTML language property processor.
 *
 * @HtmlProcessor(
 *   id = "html_language",
 *   label = @Translation("Page language"),
 * )
 */
class HtmlLanguageProcessor extends HtmlProcessorBase implements ContainerFactoryPluginInterface {

  use StringTranslationTrait;

  /**
   * Language manager.
   *
   * @var \Drupal\Core\Language\LanguageManager
   */
  protected $languageManager;

  /**
   * Constructs the HtmlLanguageProcessor object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Language\LanguageManager $language_manager
   *   The language manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, LanguageManager $language_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->languageManager = $language_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('language_manager')
    );
  }

  /**
   * Returns the translated language name taken from the lang property.
   *
   * @return string
   *   The language name. Empty string if no or unknown language was found.
   */
  public function process() {
    $language = '';

    $node = $this->DOMObject->find('html', 0);
    $languages = $this->languageManager->getStandardLanguageList();
    if (isset($node->lang)) {
      // Handle language code formats like 'nl' and 'nl_NL'.
      $langcode = strpos($node->lang, '_') ? substr($node->lang, 0, 2) : $node->lang;;
      if (isset($languages[$langcode])) {
        $language = $this->t($languages[$langcode][0]);
      }
    }
    return $language;
  }

}
