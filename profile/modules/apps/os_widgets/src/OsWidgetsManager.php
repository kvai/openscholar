<?php

namespace Drupal\os_widgets;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\os_widgets\Annotation\OsWidget;

/**
 * Provides an Os Widgets plugin manager.
 *
 * @see \Drupal\Core\Archiver\Annotation\Archiver
 * @see \Drupal\Core\Archiver\ArchiverInterface
 * @see plugin_api
 */
class OsWidgetsManager extends DefaultPluginManager {

  /**
   * Constructs a OsWidgetsManager object.
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
    parent::__construct(
      'Plugin/OsWidgets',
      $namespaces,
      $module_handler,
      OsWidgetsInterface::class,
      OsWidget::class
    );
    $this->alterInfo('os_widgets');
    $this->setCacheBackend($cache_backend, 'os_widgets_plugins');
  }

}
