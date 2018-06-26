# Security

--vv--

# Database

```php
/** @var \Drupal\Core\Database\Driver\mysql\Connection $database */
$database = \Drupal::service('database');

$id = $database
  ->query("SELECT id FROM {custom_data} WHERE name = :name", [':name' => $_GET['name']])
  ->fetchObject();

$query = $database->select('custom_data', 'd');
$query->condition('name', $name);
$query->addField('d', 'id');
$id = $query->execute();
```

The `:placeholder` content is automatically escaped.

$query->condition() escapes the condition automatically.

--vv--

# Sanitization

```php
$css_identifier = HTML::cleanCssIdentifier($unsafe_css_identifier);

$safe_url = UrlHelper::stripDangerousProtocols($unsafe_url);
$safe_url_encoded = UrlHelper::filterBadProtocol($unsafe_url);

$safe_plain_text = Html::escape($unsafe_plain_text);
$build['plain_text'] = ['#plain_text' => $unsafe_plain_text];

$safe_rich_text = check_markup($unsafe_rich_text, 'basic_html');
$build['rich_text'] = array(
  '#type' => 'processed_text',
  '#text' => $unsafe_rich_text,
  '#format' => 'basic_html',
);

$safe_of_xss = Xss::filter($unsafe_rich_text); 
$safe_of_xss_admin = Xss::filterAdmin($unsafe_rich_text);
$build['safe_markup'] = ['#markup' => $unsafe_rich_text];
```

Use of the render-array format is preferred.

`#markup` gets XSS-admin'ed.

--vv--

# Placeholders

```php
$text_plain_t = t('Plain @text.', ['@text' => $unsafe_plain_text]);
$text_em_plain = t('Emphasis %text.', ['%text' => $unsafe_plain_text]);
$text_url = t('Safe to <a href=":url">click</a>.', [':url' => $unsafe_url]);

$text_placeholder = new FormattableMarkup('Placeholder @text.', ['@text' => $unsafe_plain_text]);
```

3 placeholder types: `@plain`, `%emphasis`, `:url`.

```php
$love_you = t('<3 @you', ['@you' => $unsafe_plain_text]);
$text_plain_nested = t('I @love_you!', ['@love_you' => $love_you]);
```

`t()` returns FormattableMarkup, not a string.
