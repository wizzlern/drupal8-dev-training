<?php

namespace Drupal\wizzlern_webservice;

use Drupal\Component\Plugin\PluginInspectionInterface;
use SimpleHtmlDom\simple_html_dom;

/**
 * Defines an interface for HTML Processor plugins.
 */
interface HtmlProcessorInterface extends PluginInspectionInterface {

  /**
   * Returns the id of the processor.
   *
   * @return string
   *   The machine readable name.
   */
  public function getId();

  /**
   * Returns the name of the processor.
   *
   * @return string
   *   The processor name.
   */
  public function getName();

  /**
   * Sets the DOM object for further processing.
   *
   * @param \SimpleHtmlDom\simple_html_dom $dom
   *   The DOM object.
   *
   * @return \SimpleHtmlDom\simple_html_dom
   *   The stored DOM object.
   */
  public function setDom(simple_html_dom $dom);

  /**
   * Performs data processing.
   *
   * @return string
   *   Result of the processing.
   */
  public function process();

}
