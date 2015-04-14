<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\HtmlProcessorBase.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Component\Plugin\PluginBase;
use SimpleHtmlDom\simple_html_dom;

abstract class HtmlProcessorBase extends PluginBase implements HtmlProcessorInterface {

  /**
   * SimpleHtmlDom object containing the information to be processed.
   *
   * @var simple_html_dom
   */
  protected $DOMObject;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->pluginDefinition['label'];
  }

  /**
   * {@inheritdoc}
   */
  public function setDom($dom) {

    $this->DOMObject = $dom;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  abstract function process();

}
