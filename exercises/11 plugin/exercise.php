<?php

/**
 * Contains exercises for the Pegi field formatter plugin.
 * Estimated time: 45 min.
 */

// ==== Step 1 ====
// Create a field formatter plugin for the Pegi rating taxonomy term reference.
// - Find an example field formatter plugin in core.
// - Create a field formatter plugin class. Alternatively use Drupal Console
//   (http://drupalconsole.com/) to generate a field formatter plugin.
// - Set up the annotation. Make sure the formatter is suitable for a taxonomy
//   reference field.
// - Determine which method in the plugin is responsible for the output.
// - Provide some dummy output.
// - Modify the Games review view mode to use the new field formatter for the
//   Pegi taxonomy term field.
// - Test the result.

// ==== Step 2 ====
// Format the output: Display both the image of the referenced term and a text
// link to the term.
// - Get the image data and find out how to render image data.
// - Get the URL of the term (page).
// - Format the output as:
//   [thumbnail image]<span class="pegi-link-all">[link to term]</span>
// - Test the result.

// ==== Step 3 (optional) ====
// Use an inline template to format the output.
// - Find examples of inline templates in core ('#type' => 'inline_template').
// - Use an inline templates to format the ouptut.
// - Test the result.

// --- Fragments for step 3 ---
// - '#type' => 'inline_template',

// ==== Step 4 (optional) ====
// Make the formatter configurable.
// - Make the image size configurable.
// - Create the settings summary.
// - Test the result.
