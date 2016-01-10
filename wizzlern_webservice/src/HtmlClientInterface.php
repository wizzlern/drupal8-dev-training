<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\HtmlClientInterface.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a HtmlClient entity.
 */
interface HtmlClientInterface extends ConfigEntityInterface {

  /**
   * Returns endpoint URL.
   *
   * @return string
   *   The URL of the webservice endpoint.
   */
  public function getEndpointUrl();

  /**
   * Returns available data processors.
   *
   * @return array
   *   Array of data processor names, keyed by processor machine name.
   */
  public function getAllProcessors();

  /**
   * Returns selected data processors.
   *
   * @return array
   *   Array of processor machine names.
   */
  public function getProcessors();

}
