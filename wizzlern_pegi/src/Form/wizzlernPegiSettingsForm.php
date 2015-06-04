<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Form\WizzlernPegiSettingsForm.
 */

namespace Drupal\wizzlern_pegi\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Displays theme configuration for entire site and individual themes.
 */
class WizzlernPegiSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'wizzlern_pegi_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['wizzlern_pegi.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('wizzlern_pegi.settings');

    $form['games_page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Games page title'),
      '#default_value' => $config->get('games_page_title'),
    );

    $form['games_per_page'] = array(
      '#type' => 'number',
      '#title' => $this->t('Games per page'),
      '#description' => $this->t('The maximum number of game reviews per page'),
      '#default_value' => $config->get('games_per_page'),
      '#min' => 1,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('wizzlern_pegi.settings')
      ->set('games_per_page', $form_state->getValue('games_per_page'))
      ->set('games_page_title', $form_state->getValue('games_page_title'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
