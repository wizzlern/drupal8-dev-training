<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 */

namespace Drupal\wizzlern_pegi\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

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
   * The entity manager
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * The entity query manager
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQuery;

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
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   Entity manager service.
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   Entity query manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityManagerInterface $entity_manager, QueryFactory $entity_query) {

    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityManager = $entity_manager;
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   *
   * Setter injection is used to add additional interfaces to this block class.
   * A block class must implement ContainerFactoryPluginInterface for this
   * create() method to work.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    return new static($configuration, $plugin_id, $plugin_definition, $container->get('entity.manager'), $container->get('entity.query'));
  }

  /**
   * Overrides \Drupal\block\BlockBase::defaultConfiguration().
   */
  public function defaultConfiguration() {

    return array(
      'max_items' => 5,
    );
  }

  /**
   * Overrides \Drupal\block\BlockBase::blockForm().
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
   * Implements \Drupal\block\BlockBase::blockBuild().
   */
  public function build() {
    $items = array();
    $max = $this->configuration['max_items'];

    $nids = $this->entityQuery->get('node')
      ->condition('type', 'game')
      ->condition('status', 1)
      ->range(0, $max)
      ->sort('created', 'DESC')
      ->execute();
    $nodes = $this->entityManager->getStorage('node')->loadMultiple($nids);

    /** @var \Drupal\node\Entity\Node $node */
    foreach ($nodes as $node) {
      if ($node->access('view')) {
        $items[] = l($node->title->value, 'node/' . $node->id());
      }
    }

    return array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

  }
}
