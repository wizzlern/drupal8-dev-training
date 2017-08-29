<?php

namespace Drupal\wizzlern_pegi\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'User age' condition.
 *
 * @Condition(
 *   id = "wizzlern_pegi_age",
 *   label = @Translation("User age"),
 *   context = {
 *     "user" = @ContextDefinition("entity:user", label = @Translation("User"))
 *   }
 * );
 */
class UserAge extends ConditionPluginBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface;
   */
  protected $entityTypeManager;

  /**
   * Creates a UserAge instance.
   *
   * @param array $configuration
   *   The plugin configuration.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {

    $form['condition'] = [
      '#type' => 'select',
      '#title' => $this->t("The user's age is ..."),
      '#default_value' => $this->configuration['condition'],
      '#options' => $this->logicalConditions(),
    ];
    $options = ['0' => $this->t('Not restricted')];
    $options += $this->pegiRatings();
    $form['rating'] = [
      '#type' => 'select',
      '#title' => $this->t('Pegi rating'),
      '#default_value' => $this->configuration['rating'],
      '#options' => $options,
      '#description' => $this->t('By selecting a value enable this condition.'),
    ];
    return parent::buildConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'rating' => '0',
      'condition' => '<=',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['condition'] = $form_state->getValue('condition');
    $this->configuration['rating'] = $form_state->getValue('rating');
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function summary() {
    $ratings = $this->pegiRatings();
    $rating = $ratings[$this->configuration['rating']];
    $conditions = $this->logicalConditions();
    $condition = $conditions[$this->configuration['condition']];

    if (!empty($this->configuration['rating'])) {
      if (!empty($this->configuration['negate'])) {
        return $this->t("The user's age is @condition the @rating rating",[
          '@condition' => $condition,
          '@rating' => $rating,
        ]);
      }
      else {
        return $this->t("The user's age is not @condition the @rating rating", [
          '@condition' => $condition,
          '@rating' => $rating,
        ]);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {

    if (empty($this->configuration['rating'])) {
      return TRUE;
    }

    $result = FALSE;
    $user = $this->getContextValue('user');
    $user_age = $user->field_user_age->value;
    $term = Term::load($this->configuration['rating']);
    $allowed_age = $term->{WIZZLERN_PEGI_FIELD_ALLOWED_AGE}->value;

    switch ($this->configuration['condition']) {
      case '<':
        $result = $user_age < $allowed_age;
        break;

      case '<=':
        $result = $user_age <= $allowed_age;
        break;

      case '==':
        $result = $user_age == $allowed_age;
        break;

      case '>=':
        $result = $user_age >= $allowed_age;
        break;

      case '>':
        $result = $user_age > $allowed_age;
        break;
    }
    return $this->configuration['negate'] ? !$result : $result;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    return [
      'content' => ['taxonomy:' . WIZZLERN_PEGI_TAXONOMY_VOCABULARY],
      'module' => ['taxonomy'],
    ];
  }

  /**
   * Returns available logical conditions.
   *
   * @return array
   *   Array of conditions names keyed by their logical comparison string.
   */
  protected function logicalConditions() {

    return [
      '<' => $this->t('less than'),
      '<=' => $this->t('less or equal to'),
      '==' => $this->t('equal to'),
      '>=' => $this->t('higher or equal to'),
      '>' => $this->t('higher than'),
    ];
  }

  /**
   * Returns available Pegi ratings.
   *
   * @return array
   *   Array of Pegi rating names keyed by their taxonomy term id.
   */
  protected function pegiRatings() {
    $ratings = [];

    $tids = $this->entityTypeManager->getStorage('taxonomy_term')->getQuery()
      ->condition('vid', 'pegi_rating')
      ->sort('weight', 'ASC')
      ->sort('name', 'ASC')
      ->execute();
    $terms = Term::loadMultiple($tids);

    /** @var \Drupal\taxonomy\Entity\Term $term */
    foreach ($terms as $tid => $term) {
      $ratings[$term->id()] = $term->getName();
    }
    return $ratings;
  }

}
