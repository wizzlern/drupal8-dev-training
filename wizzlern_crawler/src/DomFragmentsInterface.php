<?php

namespace Drupal\wizzlern_crawler;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a DomFragments entity.
 *
 * @ingroup wizzlern_crawler
 */
interface DomFragmentsInterface extends ContentEntityInterface {

  /**
   * Gets the entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the entity.
   */
  public function getCreatedTime();

}
