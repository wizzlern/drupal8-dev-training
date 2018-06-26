# Blocks
- Block class
- Drupal blocks = Block plugin
- Block plugin == one class == one file.
- Plugin class extends BlockBase.
- Block ID must be unique.

--vv--

# Block definition

```php
namespace Drupal\example\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Annotation\Translation;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "example",
 *   subject = @Translation("Example title"),
 *   admin_label = @Translation("Example block")
 * )
 */
class ExampleBlock extends BlockBase {
  // ...
}
```

--vv--

# Block methods

```php
public function access(AccountInterface $account, $return_as_object = FALSE) {
  // Block access checking.
}
public function defaultConfiguration() {
  // Return an array of default configuration.
}
public function blockForm($form, FormStateInterface $form_state) {
  // The block's configuration form.
}
public function blockValidate($form, FormStateInterface $form_state) {
  // Validate the configuration form submission.
}
public function blockSubmit($form, FormStateInterface $form_state) {
  // Store the submitted config values into the configuration property.
}
public function build() {
  // Build the block output and return it as a render array.
}
```

--vv--

# ExampleBlock class

![The ExampleBlock class](assets/images/block classes.png)<!-- .element: style="width: 100%;" -->

--vv--

# User story
As a logged in user I want to see a list of most recent reviews of games that match my age.

![Screenshot List of games](assets/images/pegi-new-games-list.png)

--vv--

# Exercise
As a logged in user I want to see a list of most recent reviews of games that match my age.

- Create a Pegi module, content type and taxonomy term. 
- More details in: /03.1 pegi module/exercise.php.

- Create a custom block that shows a list of links to the 5 most recent game reviews.
- More details in: /03.2 block/.../NewGames.php.

--vv--

# Documentation
- Block API in Drupal 8 <br>https://www.drupal.org/developing/api/8/block_api
- @Block annotation keys are documented in \Drupal\Core\Block\Annotation\Block
