<?php

/**
 * Contains exercises to create a custom plugin type.
 * Estimated time: 30 minutes.
 */

// ==== Step 1 ====
// Create a custom plugin type for processing html data.
// Each processor will fetch some content from the HTML that is returned by a
// webservice client. The input is the full HTML response, the returned value
// is a string.
// - Create a plugin manager for annotation type plugins. This includes:
//   - Annotation definition class (extends Drupal\Component\Annotation\Plugin).
//   - Plugin manager and its interface (class: HtmlProcessor;
//     name: html_processor).
//   - Plugin base class (extends Drupal\Component\Plugin\PluginBase)
// - Either use Drupal Console or copy an the files from wizzlern_crawler/* in
//   this folder.
