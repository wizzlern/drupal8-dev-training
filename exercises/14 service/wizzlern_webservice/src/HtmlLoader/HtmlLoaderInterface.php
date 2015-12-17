<?php

/**
 * @file
 * Contains \Drupal\wizzlern_webservice\HtmlLoader\HtmlLoaderInterface.
 */

namespace Drupal\wizzlern_webservice\HtmlLoader;
use SimpleHtmlDom\simple_html_dom_node;


/**
 * HTML Loader interface.
 */
interface HtmlLoaderInterface {

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
