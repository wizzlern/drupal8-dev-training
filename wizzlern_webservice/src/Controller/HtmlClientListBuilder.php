<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Controller\HtmlClientListBuilder.
 */

namespace Drupal\wizzlern_webservice\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of WizzlernWebservice.
 */
class HtmlClientListBuilder extends ConfigEntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Webservice');
    $header['id'] = $this->t('Machine name');
    $header['url'] = $this->t('URL');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {

    /** @var \Drupal\wizzlern_webservice\HtmlClientInterface $entity */
    $row['label'] = $this->getLabel($entity);
    $row['id'] = $entity->id();
    $row['url'] = $entity->getEndpointUrl();
    return $row + parent::buildRow($entity);
  }

}
