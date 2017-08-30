<?php

namespace Drupal\wizzlern_crawler\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of endpoints.
 */
class EndpointListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Endpoint');
    $header['id'] = $this->t('Machine name');
    $header['url'] = $this->t('URL');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {

    /** @var \Drupal\wizzlern_crawler\EndpointInterface $entity */
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['url'] = $entity->getUrl();
    return $row + parent::buildRow($entity);
  }

}
