<?php

/**
 * @file
 * Contains Drupal\wizzlern_crawler\Entity\Form\DomFragmentsSettingsForm.
 */

namespace Drupal\wizzlern_crawler\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DomFragmentsSettingsForm.
 *
 * @package Drupal\wizzlern_crawler\Form
 *
 * @ingroup wizzlern_crawler
 */
class DomFragmentsSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'DomFragments_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for DomFragments  settings.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['DomFragments_settings']['#markup'] = 'Settings form for DomFragments. Manage field settings here.';
    return $form;
  }

}
