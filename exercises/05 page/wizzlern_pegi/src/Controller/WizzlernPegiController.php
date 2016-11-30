<?php

/**
 * @file
 * Contains \Drupal\wizzlern_pegi\Controller\WizzlernPegiController.
 */

namespace Drupal\wizzlern_pegi\Controller;

use Drupal\Core\Controller\ControllerBase;

// Exercises to create a custom page with a list Game teasers.
// Estimated time: 30 min.

// ==== Step 1 ====
// Create routing for the page.
// - Find in core an example of a page route.
// - Create a routing.yml file for WizzlernPegiController::gamesOverview.
//   using the URL '/games' and page title 'Games'.
// - TIP: Use the fragments below to make the route.
// - Access to the page requires the permission to access content.

// --- Fragments for step 1 ---
// path:
// wizzlern_pegi.games_overview:
// _controller
// _permission
// _title

// ==== Step 2 ====
// Load Game review nodes and output links to the nodes.
// - Use an entity query to load all published game reviews.
// - Find an example in core to format a node using the viewBuilder.
// - Use the viewBuilder to build the teaser view of the nodes.
// - Let the controller method return a list of teasers.
// - Also provide an empty text if no games are present.
// - Create or generate game review nodes and check the result.

// --- Fragments for step 2 ---
// $build['empty']
// '#markup'
// entityTypeManager
// getViewBuilder()
// view()

// ==== Step 3 (optional) ====
// Add a pager to the output list.
// - Find in core examples how to add a pager to the output.
// - Apply the pager with 5 items per page.
// - Check the result.

// --- Fragments for step 3 ---
// '#quantity'
// '#type' => 'pager'
// pager()

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

    $items = [];

    $build['games'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
    );

    return $build;
  }

}
