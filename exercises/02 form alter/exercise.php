<?php

/**
 * Contains exercises to modify Drupal's user login form.
 * Estimated time: 30 min.
 */

// ==== Step 1 ====
// Create a hook_form_alter() implementation to determine the form ID.
// - Search the documentation of hook_form_alter().
// - Create a [module name].module file
// - Create a function [module name]_form_alter with the right parameters.
// - Use vardump() to print the value of $form_id.
// - Go to the login page (/user) and determine the form's ID.

// ==== Step 2 ====
// Create a function to modify the login form.
// - Create a function [module name]_form_[form id]_alter with the right parameters.
// - Enable the Kint module (part of devel) to print variable data in the next
//   step. Make sure you set the required permissions.

// ==== Step 3 ====
// Modify the form array to remove the password description.
// - Use the kint() function to print the form array that is found in $form.
// - Study the form array to find the password description.
// - Write the code to remove the password description.
// - Check the result.
