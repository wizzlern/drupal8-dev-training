<?php
/**
 * @file
 * Contains Drupal\wizzlern_webservice\HtmlProcessorManager.
 */

namespace Drupal\wizzlern_webservice;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * HTML data processor plugin manager.
 */
class HtmlProcessorManager extends DefaultPluginManager {

  /**
   * Constructs an HTML Processor Manager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/HtmlProcessor', $namespaces, $module_handler, 'Drupal\wizzlern_webservice\HtmlProcessorInterface', 'Drupal\wizzlern_webservice\Annotation\HtmlProcessor');

    $this->alterInfo('wizzlern_webservice_html_processor');
    $this->setCacheBackend($cache_backend, 'wizzlern_webservice_html_processor');
  }

}
