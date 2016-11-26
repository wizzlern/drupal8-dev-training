<?php

/**
 * Contains exercises to create a custom block with recent game reviews.
 * Estimated time: 45 min.
 */

// ==== Step 1 ====
// Load Game review nodes and output links to the nodes.
// - Use the custom block code \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
// - Find examples in core to load nodes using entityQuery: entityQuery('node').
// - Use an entity query to load the 5 most recent game reviews.
// - Use the EntityInterface::toLink() method to build node links.
// - Return an list of links in the build() method.
// - TIP: You can use the code fragments below to build your code.
// - Create or generate game review nodes and check the result.

// --- Fragments for step 1 ---
// condition()
// entityQuery->get()
// entityTypeManager->loadMultiple()
// execute()
// getStorage()
// sort()

// ==== Step 2 (optional) ====
// Make the maximum number of links configurable.
// - Determine which methods may be used for a block configuration form.
// - Implement the three methods for the default configuration, the form and the
//   form submit handler.
// - Use the maximum number of links in the entity query.
// - Check the result.

// --- Fragments for step 2 ---
// $form['max_items']
// $this->configuration['max_items']
// '#type' => 'number'
// blockForm()
// blockSubmit()
// defaultConfiguration()
// range()
