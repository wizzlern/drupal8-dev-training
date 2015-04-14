<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\HtmlClientInterface.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining an HTML client entity.
 */
interface HtmlClientInterface extends ConfigEntityInterface {

  /**
   * Returns endpoint URL.
   *
   * @return string
   */
  function getEndpointUrl();

  /**
   * Returns available data processors.
   *
   * @return array
   *   Array of data processor names, keyed by processor machine name.
   */
  function getAllProcessors();

  /**
   * Returns selected data processors.
   *
   * @return array
   *   Array of processor machine names.
   */
  function getProcessors();
}
