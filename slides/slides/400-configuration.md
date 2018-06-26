# Configuration

--vv--

# Configuration
- **Configuration**: Site configuration, suitable for deployment.
  - Simple configuration
  - Configuration entities
- **Key/value store (State)**: Data of temporary nature, locally stored. Example: last_cron
- **Settings**: Environment settings, overridden in settings.php. Example: file_private_path

--vv--

# Configuration form

```yaml
# config/system.performance.yml
cache:
  page:
    max_age: 0
```

```php
# system/src/Form/PerformanceForm.php
class PerformanceForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['system.performance'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('system.performance');
    $form['caching']['page_cache_maximum_age'] = array(
      '#type' => 'select',
      '#title' => $this->('Page cache maximum age'),
      '#default_value' => $config->get('cache.page.max_age'),
      '#options' => $period,
      '#description' => $this->('The maximum time a page can be cached.'),
    );
    ...
```

--vv--

# Configuration
- ConfigFactoryInterface::get() returns an **immutable** configuration object. It can not be saved!
- ConfigFactoryInterface::getEditable() returns a **mutable** configuration object.

```php
// Just get the site name.
$site_name = \Drupal::config('system.site')->get('name');

// Set the site name.
\Drupal::configFactory()
  ->getEditable('system.site')
  ->set('name', $site_name)
  ->save();
```

--vv--

# Configuration and settings
- Overrides config with $config[...] in settings.php.
- Overrides are not visible in the administration interface. Overrides are not exported.
- $config[...] can be placed in settings.local.php

```php
// settings.php
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
```

```php
// settings.local.php
$config['system.site']['name'] = 'My development site';
```

--vv--

# Configuration files

![Directory with configuration files](assets/images/configuration-files.png)

--vv--

# State (key/value store)
- For data of temporary and local relevance.
- Not imported/exported with Configuration.

```php
/**
 * Toggles or reads the value of a flag for rebuilding the node access grants.
 */
function node_access_needs_rebuild($rebuild = NULL) {
  if (!isset($rebuild)) {
    return \Drupal::state()->get('node.node_access_needs_rebuild') ?: FALSE;
  }
  elseif ($rebuild) {
    \Drupal::state()->set('node.node_access_needs_rebuild', TRUE);
  }
  else {
    \Drupal::state()->delete('node.node_access_needs_rebuild');
  }
}
```

--vv--

# Settings
- Has hard coded defaults. Is overridden in settings.php, not configurable in a form.
- Documentation in default.settings.php

```php
// settings.php

// Override the public path to 'files' (in the Drupal root directory).
$settings['file_public_path'] = 'files';
```

```php
// Get the public file path.
$file_public_path = Settings::get('file_public_path');
```

--vv--

# Configuration schema
- Describes the structure of configuration data.
- Declares configuration types for consistency (in Configuration Management).
- Persists configuration entity properties.
- Identifies translatable configuration.
- Core data types: core.data_types.schema.yml
- https://www.drupal.org/project/config_inspector

--vv--

# Schema

```yaml
# core.data_types.schema.yml
string:
  label: 'String'
  class: '\Drupal\Core\TypedData\Plugin\DataType\StringData'
mapping:
  label: 'Mapping'
  class: '\Drupal\Core\Config\Schema\Mapping'
  definition_class: '\Drupal\Core\TypedData\MapDataDefinition'
```

```yaml
# node.schema.yml
node.type.*:
  type: config_entity
  label: 'Content type'
  mapping:
    name:
      type: label
      label: 'Name'
    type:
      type: string
      label: 'Machine-readable name'
```

--vv--

# Exercise (optional)
As a site builder I want to be able to configure the title of the Games overview page.

As a site visitor I want to see the title of the Games overview page in my own language.

- Make the page title configurable via the Pegi configuration form.
- Use Configuration Translation module to translate the page title.
- More exercise details in: _/09 configuration/.../wizzlern_pegi.schema.yml_.

--vv--

# Documentation
- Simple configuration API: https://drupal.org/node/1809490
- State (key/value store): https://drupal.org/node/1790518
- Settings: https://drupal.org/node/2181351 (a single example only).
- Configuration schema: https://www.drupal.org/node/1905070
- Disable Drupal cache during development https://www.drupal.org/node/2598914
