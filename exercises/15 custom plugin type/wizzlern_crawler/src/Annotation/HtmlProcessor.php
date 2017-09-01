<?php

namespace Drupal\wizzlern_crawler\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Html processor item annotation object.
 *
 * @see \Drupal\wizzlern_crawler\Plugin\HtmlProcessorManager
 * @see plugin_api
 *
 * @Annotation
 */
class HtmlProcessor extends Plugin {


  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
