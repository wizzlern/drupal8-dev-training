# Theming

--vv--

# Theming
- Every output is a render array.
- Render arrays can be nested.
- 4 types of output:
  - #theme
  - #type
  - #markup
  - #plain_text

--vv--

# Theming: #theme, #type
- `'#theme' => 'my_example'`: 
  - Used for everything that is defined with hook_theme().
  - theme_my_example() function
  - template_preprocess_my_example()
  - my-example.html.twig
- `'#type' => 'my_example'`: 
  - Used for all render and theme elements. 
  - See Form API documentation.

--vv--

# Theming: #attached
- Frequently used keys in $build['#attached']:
  - library
  - drupalSettings
  - placeholders 
  - html_head_link
  - http_header
  - http_head
- Library: Collection of JS and/or Style Sheets. Defined in MODULE.libraries.yml
- Dynamic library definition with hook_library_info_build().

--vv--

# Render elements
<!-- .slide: class="layout-three-col" style="font-size: 70%;"-->

@RenderElement

- actions
- ajax
- container
- contextual_links
- contextual_links_placeholder
- details
- dropbutton
- fieldgroup
- fieldset
- field_ui_table
- form
- html
- html_tag
- inline_template
- label
- link
- more_link
- operations
- page
- pager
- page_title
- processed_text
- responsive_image
- status_messages
- system_compact_link
- text_format
- toolbar
- toolbar_item
- view


--vv--

# Form elements
<!-- .slide: class="layout-three-col" style="font-size: 80%;"-->

@FormElement

- button
- checkbox
- checkboxes
- color
- date
- datelist
- datetime
- email
- entity_autocomplete
- file
- hidden
- image_button
- item
- language_configuration
- language_select
- machine_name
- managed_file
- number
- password
- password_confirm
- path
- radio
- radios
- range
- search
- select
- submit
- table
- tableselect
- tel
- textarea
- textfield
- token
- url
- value
- vertical_tabs
- weight

--vv--

# Elements

```php
// ViewEditForm.php
$build['#actions'] = array(
  '#type' => 'dropbutton',
  '#links' => $actions,
  '#attributes' => array(
    'class' => array('views-ui-settings-bucket-operations'),
  ),
);
```

```php
// CommentForm.php
$form['author']['homepage'] = array(
  '#type' => 'url',
  '#title' => $this->t('Homepage'),
  '#default_value' => $comment->getHomepage(),
  '#maxlength' => 255,
  '#size' => 30,
  '#access' => $is_admin || ($this->currentUser->isAnonymous() && $anonymous_contact != COMMENT_ANONYMOUS_MAYNOT_CONTACT),
);
```

--vv--

# In-line template

```php
$build['string'] = array(
  '#type' => 'inline_template',
  '#template' => '<span class="rainbow">{{ var }}</span>',
  '#context' => array(
    'var' => $possible_unsafe_var,
  ),
);
```

- Render element: `'#type' => 'inline_template'`
- `#template` string should not contain PHP variables. Always use Twig variables + `#context`

--vv--

# Documentation
- Default theme implementations: <br>https://api.drupal.org/api/drupal/core%21modules%21system%21theme.api.php/group/themeable/8
- Drupal 8 Form API reference: <br>https://api.drupal.org/api/drupal/developer!topics!forms_api_reference.html/8 
- Theming Drupal 8: <br>https://drupal.org/theme-guide/8
