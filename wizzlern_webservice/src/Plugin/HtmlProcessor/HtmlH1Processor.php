<?php
/**
 * @file
 * Contains \Drupal\wizzlern_webservice\Plugin\HtmlProcessor\HtmlH1Processor.
 */

namespace Drupal\wizzlern_webservice\Plugin\HtmlProcessor;

use Drupal\wizzlern_webservice\HtmlProcessorBase;

/**
 * Provides an HTML H1 tag processor.
 *
 * @HtmlProcessor(
 *   id = "h1",
 *   label = @Translation("H1 title"),
 * )
 */
class HtmlH1Processor extends HtmlProcessorBase {

  /**
   * Returns the content of the h1 tag.
   *
   * @return string
   *   The h1 tag. Empty string if not found.
   */
  public function process() {
    $node = $this->DOMObject->find('h1', 0);
    return isset($node) ? $node->plaintext : '';
  }

}
