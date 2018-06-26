# Services

--vv--

# Service
- A service is an object that provides a (globally) useful functionality.
- Examples: Configuration, Database, URL generator.
- Advantages: Decoupled & pluggable, Lazy loading.
- To find services:
  - Check *.services.yml files. Example: core.services.yml
  - Look into the static methods in \Drupal
  - Drupal console: `drupal debug:container`

--vv--

# Service Container

![Service container diagram](assets/images/service-container-diagram.png) <!-- .element: style="width: 80%;" -->

- Service definitions in *.services.yml files.
- Service container stored in database table cache_container.
- Re-compile by clearing cache or drush cr.

--vv--

# Service definition

```yaml
# core.services.yml
services:
  token:
    class: Drupal\Core\Utility\Token
    arguments: ['@module_handler', '@cache.discovery', '@language_manager', '@cache_tags.invalidator', '@renderer']

  router.route_provider:
    class: Drupal\Core\Routing\RouteProvider
    arguments: ['@database', '@state', '@path.current', '@cache.data', '@path_processor_manager', '@cache_tags.invalidator']
    tags:
      - { name: event_subscriber }
      - { name: backend_overridable }

  url_generator:
    class: Drupal\Core\Routing\UrlGenerator
    arguments: ['@url_generator.non_bubbling', '@renderer']
    calls:
      - [setContext, ['@?router.request_context']]
``` 

tags: Service tag. Additional service processing using a Compiler Pass.

--vv--

# Overriding
- Override a service:
- Extend ServiceProviderBase and use ::alter(). <br>(See https://www.drupal.org/node/2026959)
- Override in settings.local.php: <br>`$settings['container_yamls']` <br>and use/edit development.services.yml
- Override the container in settings.php:
  - `$settings['bootstrap_container_definition']`
  - `$settings['container_base_class']`

--vv--

# Notes
- Debug service container: <br>`Drupal::service("kernel")->getCachedContainerDefinition();`
- Documentation: Services and Dependency Injection
  - https://drupal.org/node/2133171
  - http://symfony.com/doc/current/book/service_container.html
- Compiler passes: 
  - http://symfony.com/doc/current/components/dependency_injection/compilation.html
