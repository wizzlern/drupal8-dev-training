<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Form\WizzlernPegiSettingsForm.
 */

namespace Drupal\wizzlern_pegi\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

// Exercises with configuration and configuration forms.
// Estimated time: 45 min.

// ==== Step 1 ====
// Create a configuration form for the maximum number of reviews to be shown on
// the games overview page.
// - Find examples of configuration forms in core.
// - Set the form ID.
// - Determine the name of the configuration that this form will modify.
// - Add the form element for the number of games on the page.
// - Save the configuration value in the submit handler.
// - Add a route for the form.
// - Test the form.

// ==== Step 2 ====
// Apply the configuration.
// - Use the configuration value in the page controller to set he maximum
//   number of games on a page.
// - Check the result.

// ==== Step 3 ====
// Set default configuration values.
// - Create a Yaml file with the default configuration value in the directory
//   wizzlern_pegi/config/install. What should be the name of this file?
// - Check the result by uninstalling and installing the wizzlern_pegi module.

# ==== Step 4 (optional) ====
# Make the configuration page appear on the Configuration page at /admin/config.
# - Find examples of configuration page links in core.
# - Add a menu item for the settings page.
# - Add a task link for the settings page.
# - Check the result.

/**
 * Displays theme configuration for entire site and individual themes.
 */
class WizzlernPegiSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    // ...
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    // ...
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // ...
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // ...
  }

}
