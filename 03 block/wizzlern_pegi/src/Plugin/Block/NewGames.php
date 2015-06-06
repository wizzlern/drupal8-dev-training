<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Plugin\Block\NewGames.
 */

namespace Drupal\wizzlern_pegi\Plugin\Block;

use Drupal\Core\Block\BlockBase;

// ==== Step 1 ====
// Set-up the @Block annotation.
// - Find a block class in core that can be used as an example.
// - Determine the interfaces that are implemented by BlockBase.
// - Use the documentation sources provided in the presentation slide.
// - Annotation keys are documented in: \Drupal\Core\Block\Annotation\Block

// ==== Step 2 ====
// Implement the build() method and enable the block.
// - Return an item list (Render Array) with dummy content.
// - Place the block in the sidebar and check the result.

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

    $items = array('one', 'two', 'three');

    return array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

  }

}
