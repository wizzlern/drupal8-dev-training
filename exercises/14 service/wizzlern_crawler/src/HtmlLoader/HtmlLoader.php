<?php

/**
 * @file
 * Contains \Drupal\wizzlern_crawler\HtmlLoader\HtmlLoader.
 */

namespace Drupal\wizzlern_crawler\HtmlLoader;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use SimpleHtmlDom\simple_html_dom;

/**
 * Fetches HTML data from remote locations.
 */
class HtmlLoader implements HtmlLoaderInterface {

  /**
   * The HTTP client to fetch the HTML data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  // see exercise.php

}
