<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Controller\WizzlernPegiController.
 */

namespace Drupal\wizzlern_pegi\Controller;

use Drupal\Core\Controller\ControllerBase;

// Exercises to create a custom block with a list of items.
// Estimated time: 30 min.

// ==== Step 1 ====
// Load Game review nodes and output links to the nodes.
// - Use an entity query to load all published game reviews.
// - Build the nodes in teaser view.
// - Let the controller method return a list of teasers.
// - Also provide an empty text if no games are present.
// - Create or generate game review nodes and check the result.

// ==== Step 2 (optional) ====
// Add a pager to the output list.
// - Find in core examples how to add a pager to the output.
// - Apply the pager with 5 items per page.
// - Check the result.

/**
 * Returns responses for Wizzlern Pegi module routes.
 */
class WizzlernPegiController extends ControllerBase {

  /**
   * Content controller callback: View games overview page.
   *
   * @return array
   *   Render array of page output.
   */
  public function gamesOverview() {

    $items = array('one', 'two', 'three');

    $build['games'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

    return $build;
  }

}
