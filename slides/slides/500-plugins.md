# Plugins

--vv--

# Plugins
- Plugins are not modules.
- Plugins are...
  - Action, AggregatorFetcher, AggregatorParser, AggregatorProcessor, Archiver, Block, CKEditor, Condition, config_translation, Constraint, ContextualLink, DataType, Editor, EntityReferenceSelection, EntityType, FieldFormatter, FieldType, FieldWidget, Filter, Formatter, ImageEffect, ImageToolkit, InPlaceEditor, LanguageNegotiationMethod, LocalAction, LocalTask, Mail, MigrateProcess, Resource, RestResource, Search, Selection, Test, Tip, TypedData, Views, ViewsHandler, Widget.

--vv--

# Plugins
- Plugins:
  - Typical use case: Field widgets, field formatters.
  - Many possible solutions for one problem.
  - Have a narrow use case. Share same interface.

--vv--

# Block plugin

```php
use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "example",
 *   subject = @Translation("Example Block"),
 *   admin_label = @Translation("Example Block")
 * )
 */
class ExampleBlock extends BlockBase {

  public function build() {
    return array(
      '#markup' => ...
    );
  }
}
```

--vv--

# Field Formatter plugin

```php
namespace Drupal\example\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * @FieldFormatter(
 *   id = "example_field_formatter",
 *   label = @Translation("Example formatter"),
 *   field_types = {
 *     "text"
 *   }
 * )
 */
class ExampleFieldFormatter extends FormatterBase {

  public function viewElements(FieldItemListInterface $items) {
    foreach ($items as $delta => $item) {
      $elements[$delta] = ...
    }
    return $elements;
  }
}
```

--vv--

# Local action plugin

```yaml
# node.links.action.yml

node.add_page:
  route_name: node.add_page
  title: 'Add content'
  appears_on:
    - system.admin_content
``` 

Same plugin ID as route_name is best practice.

--vv--

# Exercise
As a visitor I want to be able to browse all games of a certain rating using an 'All games with this rating' link that companies the rating icon.

![Screenshot of rendered icon with link](assets/images/pegi-field-formatter.png)

- Create a custom field formatter for a Pegi rating entity reference field.
- More exercise details in: _/11 plugin/exercise.php_.
