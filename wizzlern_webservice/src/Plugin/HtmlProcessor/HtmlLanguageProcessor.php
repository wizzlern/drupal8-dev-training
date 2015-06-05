<?php
/**
 * @file
 * Contains \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlLanguageProcessor.
 */

namespace Drupal\wizzlern_webservice\Plugin\HtmlProcessor;

use Drupal\Core\Language\LanguageManager;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\wizzlern_webservice\HtmlProcessorBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an HTML language property processor.
 *
 * @HtmlProcessor(
 *   id = "language",
 *   label = @Translation("Page language"),
 * )
 */
class HtmlLanguageProcessor extends HtmlProcessorBase implements ContainerFactoryPluginInterface {

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
   * Returns the content of the language tag.
   *
   * @return string
   *   The language name.
   */
  public function process() {
    $node = $this->DOMObject->find('html', 0);
    return $this->languageManager->getLanguageName($node->lang);
  }

}
