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
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Language\LanguageManager $language_manager
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $language_manager) {
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
   * Returns the content of the h1 tag.
   *
   * @return string
   */
  function process() {
    $node = $this->DOMObject->find('html', 0);
    return $this->languageManager->getLanguageName($node->lang);
  }
}
