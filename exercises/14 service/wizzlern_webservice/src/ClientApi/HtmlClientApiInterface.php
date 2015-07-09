<?php

/**
 * @file
 * Contains \Drupal\wizzlern_webservice\ClientApi\HtmlClientApiInterface.
 */

namespace Drupal\wizzlern_webservice\ClientApi;
use SimpleHtmlDom\simple_html_dom_node;


/**
 * HTML Client API interface.
 */
interface HtmlClientApiInterface {

  /**
   * Fetches the HTML DOM of a web page.
   *
   * @param string $url
   *   URL of the web page.
   *
   * @return simple_html_dom_node
   *   DOM node object containing the web page content.
   *
   * @throws \Exception
   *   When the operation failed.
   */
  public function loadDom($url);

}
