<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\DomFragmentsInterface.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a DomFragments entity.
 *
 * @ingroup wizzlern_webservice
 */
interface DomFragmentsInterface extends ContentEntityInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
