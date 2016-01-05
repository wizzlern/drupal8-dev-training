<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 */

namespace Drupal\wizzlern_pegi\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a recent games block.
 *
 * @Block(
 *   id = "wizzlern_pegi_new_games",
 *   subject = @Translation("New games"),
 *   admin_label = @Translation("New games")
 * )
 */
class NewGames extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The entity query manager.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQuery;

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The current user's account.
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new NewGames block instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_type_manager
   *   Entity manager service.
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   Entity query manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, QueryFactory $entity_query, RendererInterface $renderer, AccountProxyInterface $current_user) {

    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
    $this->entityQuery = $entity_query;
    $this->renderer = $renderer;
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   *
   * Setter injection is used to add additional interfaces to this block class.
   * A block class must implement ContainerFactoryPluginInterface for this
   * create() method to work.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('entity.query'),
      $container->get('renderer'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {

    return array(
      'max_items' => 5,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['max_items'] = array(
      '#type' => 'number',
      '#title' => t('Number of games'),
      '#size' => 15,
      '#description' => t('The maximum number of games to show.'),
      '#default_value' => $this->configuration['max_items'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['max_items'] = $form_state->getValue('max_items');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $items = [];
    $max = $this->configuration['max_items'];

    $nids = $this->entityQuery->get('node')
      ->condition('type', WIZZLERN_PEGI_GAME_CONTENT_TYPE)
      ->condition('status', 1)
      ->range(0, $max)
      ->sort('created', 'DESC')
      ->execute();
    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

    /** @var \Drupal\node\Entity\Node $node */
    foreach ($nodes as $node) {
      if ($node->access('view')) {
        $items[] = $node->toLink();
        $this->renderer->addCacheableDependency($build, $node);
      }
    }

    if ($items) {
      $build['links'] = array(
        '#theme' => 'item_list',
        '#items' => $items,
      );

      // Add cache properties for the current user.
      // The block content varies per user and should be invalidated when the
      // account changes. The user entity does not (yet) contain this info.
      // Using tag 'user:[uid]' no longer works if we story the user's birthday
      // instead of the age.
      $build['links']['#cache'] = array(
        'context' => ['user'],
        'tags' => ['user:' . $this->currentUser->id()]
      );
    }
    else {
      $build['empty'] = array(
        '#markup' => $this->t('Bummer, no game reviews.')
      );
    }

    // The cache must be invalidated when a new game is created.
    $build['#cache']['tags'][] = 'wizzlern_pegi.new_game';

    return $build;
  }

}
