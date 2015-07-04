<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Condition\UserAge.
 */

namespace Drupal\wizzlern_pegi\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;

// ==== Step 1 ====
// Make a condition plugin for visibility based on the user’s age.
// - Find examples of condition plugins in core.
// - Set up the plugin annotation.
// - Determine the plugin dependencies.
// - Implement the required summary() method.
// - Create a simplified evaluation comparing the user age with a fixed value.
// - Apply the condition to any block and check the result.

// ==== Step 2 ====
// Make the threshold age configurable.
// - Add a configuration form to enter the threshold age category.
// - Evaluate to true if the uses age is larger or equal to the selected age.
// - Support the build in 'negate' option.
// - Check the result.

// ==== Step 3 (optional) ====
// Make the Pegi level and the condition (>, >=, =, etc.) configurable.
// - Add selector options to the form.
// - Use the selector in the evaluation.
// - Check the result.

/**
 * Provides a 'User age' condition.
 *
 * @Condition(
 *   id = ...
 * );
 */
class UserAge extends ConditionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function summary() {
    // ...
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {

    $result = TRUE;
    // ...

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    // ...
  }

}
