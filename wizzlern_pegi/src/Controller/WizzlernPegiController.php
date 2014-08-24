<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Controller\WizzlernPegiController.
 */

namespace Drupal\wizzlern_pegi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Wizzlern Pegi module routes.
 */
class WizzlernPegiController extends ControllerBase {

  /**
   * The entity manager
   *
   * @var EntityManagerInterface
   */
  protected $entityManager;

  /**
   * The entity query manager
   *
   * @var QueryFactory
   */
  protected $entityQuery;

  /**
   * @todo
   *
   * @param EntityManagerInterface $entity_manager
   * @param QueryFactory $entity_query
   */
  public function __construct(EntityManagerInterface $entity_manager, QueryFactory $entity_query) {

    $this->entityManager = $entity_manager;
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {

    return new static(
      $container->get('entity.manager'),
      $container->get('entity.query')
    );
  }

  /**
   * Controller content callback: All games.
   *
   * @return array
   *   Render array of page output.
   */
  public function allGames() {
    $items = array();

    $nids = $this->entityQuery->get('node')
      ->condition('type', 'game')
      ->condition('status', 1)
      ->sort('created')
      ->pager(5)
      ->execute();
    $nodes = $this->entityManager->getStorage('node')->loadMultiple($nids);

    foreach ($nodes as $nid => $node) {
      $items[$nid] = $this->entityManager->getViewBuilder('node')->view($node, 'teaser');
    }
    $build['games'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );
    $build['pager'] = array('#theme' => 'pager');

    return $build;
  }

}
