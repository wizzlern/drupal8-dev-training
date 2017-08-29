<?php

namespace Drupal\wizzlern_pegi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Wizzlern Pegi module routes.
 */
class WizzlernPegiController extends ControllerBase {

  /**
   * The type entity manager.
   *
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The current user's account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a content controller.
   *
   * @param EntityTypeManagerInterface $entity_type_manager
   *   Entity manager.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   The current user account service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, AccountProxyInterface $current_user) {

    $this->entityTypeManager = $entity_type_manager;
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   *
   * This class requires entity_type.manager and entity.query services, but they
   * are not available in the the controller base class. The create() method is
   * used to instantiate the controller with the required services. Pointers to
   * the services are passed on to the class constructor where they are stored
   * in the class for further use.
   */
  public static function create(ContainerInterface $container) {

    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_user')
    );
  }

  /**
   * Content controller callback: View games overview page.
   *
   * @return array
   *   Render array of page output.
   */
  public function gamesOverview() {
    $items = array();
    $config = $this->config('wizzlern_pegi.settings');

    // Set the page title.
    $build['#title'] = $config->get('games_page_title');

    // Load all published games. The pager() method is used to limit the number
    // of results and to prepare the query for paging.
    $nids = $this->entityTypeManager->getStorage('node')->getQuery()
      ->condition('type', 'game')
      ->condition('status', 1)
      ->sort('created', 'DESC')
      ->pager($config->get('games_per_page'))
      ->execute();
    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

    // Build a list of node teasers. The EntityViewBuilder and NodeViewBuilder
    // classes have several methods to build the output render array.
    /** @var \Drupal\node\Entity\Node $node */
    foreach ($nodes as $nid => $node) {
      // @todo remove this type of access control. It 'breaks' the pager.
      // @todo Find out what to do with anonymous users. Show no games?
      if ($node->access('view')) {
        $items[$nid] = $this->entityTypeManager->getViewBuilder('node')
          ->view($node, 'teaser');
      }
    }
    if ($items) {
      // The access control is per user, so we set a cache context for user.
      $build['games'] = array(
        '#theme' => 'item_list',
        '#items' => $items,
        '#cache' => array(
          'contexts' => ['user'],
          'tags' => ['user:' . $this->currentUser->id()],
        ),
      );

      // Add a pager to the output.
      $build['pager'] = array(
        '#type' => 'pager',
        '#quantity' => 4,
      );
    }
    else {
      $build['empty'] = array(
        '#markup' => $this->t('Bummer, we have no game reviews for you now :('),
      );
    }

    // The cache must be invalidated when a new game is created.
    $build['#cache']['tags'][] = 'wizzlern_pegi.new_game';

    return $build;
  }

}
