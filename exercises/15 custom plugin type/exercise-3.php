<?php

/**
 * Contains exercises using our custom plugin type.
 * Estimated time: 120 minutes.
 */

// ==== User story ====
// As a site administrator I want to extract the following data from the HTML
// DOM: Processor meta tag, H1 tag, Page language.

// ==== Step 1 ====
// Create the first plugin
// - Determine the scope and the functionality of the plugin.
//   - What is the overall functionality?
//   - What role does the plugin play in it?
// - Determine the interface of the plugin.
//   - What data will the plugin receive, in which form?
//   - What data will the plugin return, in which form?
// - Build the code around the plugin
//   - Write (sketch) code that calls the plugin and returns data to the page.
// - Build the first plugin and show the result on the diagnostic page.
//   - Write the plugin and return (dummy) data.
// - Evaluate and rework
//   - Does the plugin match the interface design and the overall functionality?
//   - Is the interface re-usable for other plugins?
//   - Is the OO structure correct and not over-designed?

// ==== Step 2 ====
// Make the plugins selectable per webservice endpoint.
// - Add a plugin selection to the webservice entity configuration form.
//   - Multiple plugins can be selected.

// ==== Step 3 ====
// Show the processed data per endpoint on the diagnostic page.
// - Modify the diagnostic page to show the HTML data extracted by each of the
//   plugins and all webservices.

// ==== Step 4 (optional) ====
// Show the page language in a readable format (e.g. "Dutch")
// - Drupal core has English and native names of languages. Determine where.
// - Use Dependency Injection to load this service.
// - Return a translated readable language name.
