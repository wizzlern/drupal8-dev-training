<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Condition\UserAge.
 */

namespace Drupal\wizzlern_pegi\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\taxonomy\Entity\Term;

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
class UserAge extends ConditionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {

    $form['condition'] = array(
      '#type' => 'select',
      '#title' => $this->t("The user's age is ..."),
      '#default_value' => $this->configuration['condition'],
      '#options' => $this->logicalConditions(),
    );
    $form['rating'] = array(
      '#type' => 'select',
      '#title' => $this->t('Pegi rating'),
      '#default_value' => $this->configuration['rating'],
      '#required' => TRUE,
      '#options' => $this->pegiRatings(),
    );
    return parent::buildConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'rating' => array(),
      'condition' => '==',
    ) + parent::defaultConfiguration();
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

    if (!empty($this->configuration['negate'])) {
      return $this->t("The user's age is @condition the @rating rating", array('@condition' => $condition, '@rating' => $rating));
    }
    else {
      return $this->t("The user's age is not @condition the @rating rating", array('@condition' => $condition, '@rating' => $rating));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {

    $result = FALSE;
    $user = $this->getContextValue('user');
//debug($user);
    $user_age = 8;

    switch ($this->configuration['condition']) {
      case '<':
        $result = $user_age < $this->configuration['rating'];
        break;

      case '<=':
        $result = $user_age <= $this->configuration['rating'];
        break;

      case '==':
        $result = $user_age == $this->configuration['rating'];
        break;

      case '>=':
        $result = $user_age >= $this->configuration['rating'];
        break;

      case '>':
        $result = $user_age > $this->configuration['rating'];
        break;
    }
    return $this->configuration['negate'] ? !$result : $result;
  }

  /**
   * Returns available conditions.
   *
   * @return array
   *   Array of conditions names keyed by their comparison sign.
   */
  protected function logicalConditions() {

    return array(
      '<' => $this->t('less than'),
      '<=' => $this->t('less or equal to'),
      '==' => $this->t('equal to'),
      '>=' => $this->t('higher or equal to'),
      '>' => $this->t('higher than'),
    );
  }

  /**
   * Returns available Pegi ratings.
   *
   * @return array
   *   Array of Pegi rating names keyed by their taxonomy term id.
   */
  protected function pegiRatings() {
    $ratings = array();

    $tids = \Drupal::service('entity.query')->get('taxonomy_term')
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
