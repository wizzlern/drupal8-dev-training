<?php
/**
 * @file
 * Contains \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlGeneratorProcessor.
 */

namespace Drupal\wizzlern_webservice\Plugin\HtmlProcessor;

use Drupal\wizzlern_webservice\HtmlProcessorBase;

/**
 * Provides an HTML Generator meta tag processor.
 *
 * @HtmlProcessor(
 *   id = "generator",
 *   label = @Translation("Generator"),
 * )
 */
class HtmlGeneratorProcessor extends HtmlProcessorBase {

  /**
   * Returns the content of the Generator meta tag.
   *
   * @return string
   */
  function process() {
    $node = $this->DOMObject->find('meta[name=Generator]', 0);
    return isset($node) ? $node->content : '';
  }
}
