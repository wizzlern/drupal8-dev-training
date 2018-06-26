# Namespace

--vv--

# Namespace

```php
// core/lib/Drupal/Core/Form/FormBase.php
namespace Drupal\Core\Form;

abstract class FormBase implements FormInterface, ContainerInjectionInterface {
 // ...
}
```


```php
// modules/custom/example/src/Form/ExampleForm.php
namespace Drupal\example\Form;

use Drupal\Core\Form\FormBase;

class ExampleForm extends FormBase {
  // ...
}
```

Fully qualified class name
= namespace + class name

--vv--

# Namespace

- Namespace must be unique within the project.
- Class name must be unique within the namespace.
- Namespace relates to module name and path.
- Class is automatically loaded when used in 'use' statement.
- Except in 'use' statement name spaces start with '\'.
