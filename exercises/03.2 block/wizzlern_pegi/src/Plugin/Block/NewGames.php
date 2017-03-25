<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 */

// Exercises to create a custom block with a list of items.
// Estimated time: 30 min.

// ==== Step 1 ====
// Set up the @Block annotation.
// - Find a block class in core that can be used as an example. (But not in the
//   Block module).
// - Find and read the interfaces that are implemented by BlockBase.
// - Complete the @Block annotation below.
//   - Use the documentation sources provided in the presentation slide.
//   - Annotation keys are documented in: \Drupal\Core\Block\Annotation\Block.

// ==== Step 2 ====
// Use the build() method and enable the block.
// - Read the code that is currently used in the build() method.
// - Modify the code to return a list of dummy content.
// - Place the block in the sidebar and check the result.

namespace Drupal\wizzlern_pegi\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a recent games block.
 *
 * @Block(
 *   id = ...
 * )
 */
class NewGames extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $items = [];

    $build = [
      '#theme' => 'item_list',
      '#items' => $items,
    ];

    return $build;
  }

}
