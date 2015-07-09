<?php

/**
 * @file
 * Contains \Drupal\wizzlern_webservice\ClientApi\HtmlClientApi.
 */

namespace Drupal\wizzlern_webservice\ClientApi;

/**
 * Fetches HTML data from remote locations.
 */
class HtmlClientApi implements HtmlClientApiInterface {

  /**
   * The HTTP client to fetch the HTML data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  // see exercise.php

}
