<?php

/**
 * Contains exercises for \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 */

// ==== Step 1 ====
// Add cache tags to the block output.
// - Determine when the block cache must be invalidated.
// - Add the node cache tags to the block render array.
// - Check if a changed node title is visible in the block.

// ==== Step 2 ====
// Add cache context to the block output
// - Add the node cache contexts to the block render array.
// - Look into the cache_render database table and compare the cid with the
//   added contexts.

// ==== Step 3 (optional) ====
// Invalidate the new games block cache when a games node is created.
// - Explain why creating a new game review node does not invalidate the block
//   cache.
// - Determine which trigger can be used to invalidate the block cache.
// - Invalidate the block cache when a game review node is created.
// - Check the result.
