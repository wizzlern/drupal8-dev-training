<?php

/**
 * @file
 * Contains dom_fragments.page.inc.
 *
 * DomFragments page callback file for the dom_fragments entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for dom_fragments templates.
 *
 * Default template: dom_fragments.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_dom_fragments(array &$variables) {
  // Fetch DomFragments Entity Object.
  $dom_fragments = $variables['elements']['#dom_fragments'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
