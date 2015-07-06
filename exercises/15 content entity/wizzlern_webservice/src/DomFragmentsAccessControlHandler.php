<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\DomFragmentsAccessControlHandler.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the DomFragments entity.
 *
 * @see \Drupal\wizzlern_webservice\Entity\DomFragments.
 */
class DomFragmentsAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view DomFragments entity');

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit DomFragments entity');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete DomFragments entity');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add DomFragments entity');
  }

}
