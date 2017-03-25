<?php

/**
 * Contains exercises with a custom block of recent game reviews.
 * Estimated time: 45 min.
 */

// ==== Step 1 ====
// Add cache meta data to the block output.
// - Work with the custom block code from the previous exercises.
// - Determine when the block cache must be invalidated.
// - Add the node's caching information to the render array.
// - Debug the render array to see what caching information was added.
// - Check if a changed node title is visible in the block.

// --- Fragments for step 1 ---
// - renderer
// - addCacheableDependency

// ==== Step 2 (optional) ====
// Invalidate the new games block cache when a games node is created.
// - Check that creating a new game review node does not invalidate the block
//   cache. Can you explain why?
// - Determine which trigger can be used to invalidate the block cache.
// - Invalidate the block cache when a game review node is created.
// - Check the result.
