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
   * Constructs a content controller.
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
   *
   * This class requires entity.manager and entity.query services, but they are
   * not available in the the controller base class. The create() method is used
   * to instantiate the controller with the required services. Pointers to the
   * services are passed on to the class constructor where they are stored in
   * the class for further use.
   */
  public static function create(ContainerInterface $container) {

    return new static(
      $container->get('entity.manager'),
      $container->get('entity.query')
    );
  }

  /**
   * Content controller callback: All games.
   *
   * @return array
   *   Render array of page output.
   */
  public function allGames() {
    $items = array();

    // Load all published games. The pager() method is used to limit the number
    // of results and to prepare the query for paging.
    $nids = $this->entityQuery->get('node')
      ->condition('type', 'game')
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->pager(5)
      ->execute();
    $nodes = $this->entityManager->getStorage('node')->loadMultiple($nids);

    // Build a list of node teasers. The EntityViewBuilder and NodeViewBuilder
    // classes have several methods to build the output render array.
    /** @var \Drupal\node\Entity\Node $node */
    foreach ($nodes as $nid => $node) {
      if ($node->access('view')) {
        $items[$nid] = $this->entityManager->getViewBuilder('node')
          ->view($node, 'teaser');
      }
    }

    $build['games'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );
    // Thanks to the pager() method above, it is very easy to add a pager
    // to the output.
    $build['pager'] = array('#theme' => 'pager');

    return $build;
  }

}
