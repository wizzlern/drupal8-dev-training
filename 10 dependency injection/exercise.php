<?php

/**
 * Contains exercises for \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 * Estimated time: 30 min.
 */

// ==== Step 1 ====
// Replace procedural code inside block plugin class by OO solutions.
// - Check \Drupal\wizzlern_pegi\Controller\WizzlernPegiController for
//   procedural code.
// - Replace procedural calls to services with dependency injection.
//   For example \Drupal::entityManager(). Let the class implement
//   'ContainerFactoryPluginInterface' and inject the required service.
// - Have you used the procedural t() function? Not good, replace it with the
//   OO way to call the translation function.

// ==== Step 2 ====
// Replace procedural code inside controller class by OO solutions.
// - Check \Drupal\wizzlern_pegi\Plugin\Block\NewGames for procedural code.
// - Replace procedural calls to services with dependency injection.
//   For example \Drupal::entityManager(). Note that the ControllerBase already
//   implements 'ContainerFactoryPluginInterface'.

// ==== Step 3 (optional) ====
// Use the API.
// - Have you used 'node/[nid]' to build the URL to a node? In Drupal 8 there is
//   a dedicated method that returns the URL of an entity. Use it instead.
