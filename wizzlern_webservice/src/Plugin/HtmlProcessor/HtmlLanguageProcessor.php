<?php
/**
 * @file
 * Contains \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlLanguageProcessor.
 */

namespace Drupal\wizzlern_webservice\Plugin\HtmlProcessor;

use Drupal\Core\Language\LanguageManager;
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
class HtmlLanguageProcessor extends HtmlProcessorBase {

  /**
   * Language manager.
   *
   * @var \Drupal\Core\Language\LanguageManager
   */
  protected $languageManager;

  /**
   * Constructs the HtmlLanguageProcessor object.
   *
   * @param \Drupal\Core\Language\LanguageManager $language_manager
   */
  public function __construct(LanguageManager $language_manager) {
    $this->languageManager = $language_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
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
