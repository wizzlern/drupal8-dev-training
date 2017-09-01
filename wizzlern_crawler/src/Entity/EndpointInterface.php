<?php

namespace Drupal\wizzlern_crawler\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining an Endpoint entity.
 */
interface EndpointInterface extends ConfigEntityInterface {

  /**
   * Returns endpoint URL.
   *
   * @return string
   *   The URL of the crawler endpoint.
   */
  public function getUrl();

  /**
   * Returns available data processors.
   *
   * @return array
   *   Array of data processor names, keyed by processor machine name.
   */
  public function getAllProcessors();

  /**
   * Returns configured data processors.
   *
   * @return array
   *   Array of processor machine names.
   */
  public function getConfiguredProcessors();

}
