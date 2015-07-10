<?php
/**
 * @file
 * Contains Drupal\wizzlern_webservice\HtmlProcessorInterface.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Component\Plugin\PluginInspectionInterface;

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
   * Performs data processing.
   *
   * @return string
   *   Result of the processing.
   */
  public function process();

}
