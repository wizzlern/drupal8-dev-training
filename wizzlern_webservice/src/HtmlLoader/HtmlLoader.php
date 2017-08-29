<?php

namespace Drupal\wizzlern_webservice\HtmlLoader;

use GuzzleHttp\ClientInterface;
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

  /**
   * Instantiates this client class.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   A Guzzle client object.
   */
  public function __construct(ClientInterface $http_client) {
    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   *
   * @throws \LogicException
   *   When the handler does not populate a response.
   * @throws RequestException
   *   When an error is encountered.
   */
  public function loadDom($url) {

    // Load HTML data from endpoint.
    $response = $this->httpClient->get($url);
    $html = $response->getBody()->getContents();

    // Return the HTML as SimpleHtmlDom object.
    $dom = new simple_html_dom($html);
    return $dom;
  }

}
