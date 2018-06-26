# Forms

--vv--

# Form API
- Form API uses arrays to define form elements.
- Form API provides security.

```php
$form['name'] = array(
  '#type' => 'textfield',
  '#title' => $this->t('Username'),
  '#size' => 60,
  '#maxlength' => USERNAME_MAX_LENGTH,
  '#description' => $this->t('Enter your @s username.', ...
  '#required' => TRUE,
);
```

--vv--

# Form flow

![Data flow diagram of form submission](assets/images/form-processing-diagram.png) <!-- .element: style="width: 60%;" -->

--vv--

# Form usage
- Form as a page (e.g. Configuration): <br>Route + Form class
- Include a form (e.g. in a block): <br>FormBuilderInterface::getForm()
- Alter a form:
  - hook_form_alter()
  - hook_form_FORM_ID_alter()
- Popular base forms: FormBase, ConfigFormBase, ConfirmFormBase, ViewsFormBase.

--vv--

# Form router

```yaml
# example.routing.yml

# Defines a form route.
example.basic_form:
  path: '/basic/form'
  defaults:
    _title: 'Basic form'
    _form: '\Drupal\example\Forms\BasicForm'
  requirements:
    _permission: 'access content'
```

To include a form in a block use: <br>`$form = $this->formBuilder->getForm($form_class);`

--vv--

# Form class

```php
namespace Drupal\example\Form;

use Drupal\Core\Form\FormBase;

/**
 * Implements an example form.
 */
class BasicForm extends FormBase {

 public function getFormID() {
    return 'example_basic_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // Building the form.
    return $form;
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate the form submission.
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Process the for submission.
  }
}
```

--vv--

# Altering forms

```php
/**
 * Implements hook_form_alter()
 *
 * Alters every form.
 */
function example_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Alter the form.
}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Alters only the Search form 'search_block_form'.
 */
function example_form_search_block_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Alter the form.
}
```

--vv--

# Exercise
As a site administrator I want to configure the number of reviews on the Games overview page.

- Create a configuration form for the maximum number of reviews to be shown on the games overview page.
- Add links to make the form appear on the configuration overview page.
- More exercise details in: _/08 form/.../wizzlernPegiSettingsForm.php_.

--vv--

# Notes
- Default validation and submit handlers are **always** called. 
- Default: validateForm(), submitForm()

--vv--

# Documentation
- Drupal 8 Form API introduction https://drupal.org/node/2117411
- Drupal 8 Form API reference https://api.drupal.org/api/drupal/elements/8.2.x
