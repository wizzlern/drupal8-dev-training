# Dependency Injection

--vv--

# Dependency
NOT Clutter-free, NOT Reusable, NOT Testable

```php
function my_module_func($value) {
  module_load_include('other_module', 'inc');
  $processed_value = other_module_process_val($value);
  // ...
  return $result;
}
```

```php
class Notifier {
  private $mailer;

  public function __construct() {
    $this->mailer = new Mailer();
  }

  public function notify() {
    // ...
    $this->mailer->send($from, $to, $msg);
  }
}
```

--vv--

# Dependency
IS Clutter-free, IS Reusable, IS Testable

```php
class Notifier {
  private $mailer;

  public function __construct(MailerInterface $mailer) {
    $this->mailer = $mailer;
  }

  public function notify() {
    // ...
    $this->mailer->send($from, $to, $msg);
  }
}

$mailer = new Mailer();
$notifier = new Notifier($mailer);
```

Often, these injected classes (e.g. `$mailer`) are _Services_.

--vv--

# Service dependencies
Services are stand-alone pieces of code that ‘do things’. Services are often injected as dependency. Services can depend on other services.

```yaml
services:
  breadcrumb:
    class: Drupal\Core\Breadcrumb\BreadcrumbManager
    arguments: ['@module_handler']

  language_manager:
    class: Drupal\Core\Language\LanguageManager
    arguments: ['@language.default']

  router.dumper:
    class: Drupal\Core\Routing\MatcherDumper
    arguments: ['@database']
```

--vv--

# Constructor Injection

```php
namespace Drupal\Core\Breadcrumb;
use Drupal\Core\Extension\ModuleHandlerInterface;

class BreadcrumbManager implements ChainBreadcrumbBuilderInterface {

  protected $moduleHandler;

  public function __construct(ModuleHandlerInterface $module_handler) {
    $this->moduleHandler = $module_handler;
  }

  public function build(array $attributes) {
    // ...

    // Allow modules to alter the breadcrumb.
    $this->moduleHandler->alter('system_breadcrumb', $breadcrumb, $route_match, $context);
    return $breadcrumb;
  }
}
```

--vv--

# Setter Injection

```php
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

class CKEditor extends EditorBase implements ContainerFactoryPluginInterface {

  public function __construct(array $configuration, $plugin_id, $plugin_definition, ...
    LanguageManagerInterface $language_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    ...
    $this->languageManager = $language_manager;
  }

  public static function create(ContainerInterface $container, array $configuration,
    $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      ...
     $container->get('language_manager')
    );
  }
}
```

Implement ContainerFactoryPluginInterface to allow DI on plugins.

--vv--

# Setter Injection
- Base classes that implement ContainerInjectionInterface:
  - ControllerBase
  - FormsBase
  - ConfigController
- Plugins are prepared for DI. Let your plugin (e.g. Block) implement ContainerFactoryPluginInterface and implement ::create and ::__construct.

--vv--

# Exercise
As a developer I want to use dependency injection to include services in my objects.

- Use dependency injection to load services in OO classes such as Controllers and Plugins.
- More exercise details in: _/10 dependency injection/exercise.php_.
