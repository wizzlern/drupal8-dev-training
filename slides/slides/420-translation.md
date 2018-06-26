# Translation

--vv--

# Translation
- Interface translation
  - System messages, admin interface, all hardcoded strings wrapped in `$this->t()`
- Content translation
  - Nodes, taxonomy terms, menu items, field contents.
- Configuration translation
  - Field labels, configurable interface text (e.g. site name)

--vv--

# Interface translation

```php
use StringTranslationTrait;

'#description' => $this->t('Enter the password that accompanies your username.'),

'#title' => t('Exit block region demonstration'),

$title = $this->t('Edit entity @entity', ['@entity' => $entity->label()]);
```

- Placeholders:
  - **@text**	Converted to plain text
  - **%text**	Converted to plain text + `<em>` tag
  - **:url** Filters dangerous protocols

--vv--

# t functions
- PHP
  - `$this->t()`
  - `$this->format_plural()`
- JavaScript:
  - `Drupal.t()`
  - `Drupal.formatPlural()`
- Trait
  - `StringTranslationTrait`

--vv--

# Exercise
Check the code you have written for translatable strings.

- Use (`StringTranslationTrait` and) `$this->t()` for OO code.
- Use the `t()` function for all procedural code.
- Use a placeholder if a string contains a variables.
- Optional: Inject unsafe code into a string with and without a placeholder. (http://ha.ckers.org/xss.html)

--vv--

# Best practice
- Always use `$this->t()` for interface text. Also in Dutch websites.
- Avoid the use of \" of \'  inside t strings. This may confuse translators.
- Export translatable strings from custom code: http://drupal.org/project/potx
