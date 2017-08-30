<?php

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a Endpoint entity.
 */
interface EndpointInterface extends ConfigEntityInterface {

  /**
   * Returns endpoint URL.
   *
   * @return string
   *   The URL of the webservice endpoint.
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
