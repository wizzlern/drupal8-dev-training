<?php

/**
 * Contains exercises for the Pegi field formatter plugin.
 * Estimated time: 45 min.
 */

// ==== Step 1 ====
// Create a field formatter plugin for the Pegi rating taxonomy term reference.
// - Find an example field formatter plugin in core.
// - Create a field formatter plugin class.
// - Set up the annotation.
// - Provide dummy output.
// - Apply the field formatter to the Pegi taxonomy term field in the Games
//   review content type.
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

// ==== Step 4 (optional) ====
// Make the formatter configurable.
// - Make the image size configurable.
// - Create the settings summary.
// - Test the result.
