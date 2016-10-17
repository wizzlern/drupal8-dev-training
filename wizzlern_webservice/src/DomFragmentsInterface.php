<?php

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a DomFragments entity.
 *
 * @ingroup wizzlern_webservice
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
