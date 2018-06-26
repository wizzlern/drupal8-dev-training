# Modify forms

--vv--

# The hook system
- Hooks is a procedural observer/listener pattern.
  - Modify data: hook_*_alter()
  - Extend an existing proces: bijv. hook_cron(), hook_ENTITY_TYPE_view(). 
- Documented in MODULE.api.php files.
- Detected and called based on the function name: [module name]_[hook name].

--vv--

# Exercise
We can get an (incomplete) picture of the hooks by listening-in on the method that calls many hooks.

- Add a call to drupal_set_message() at the first line in ModuleHandler::invokeAll() <br>in core/lib/Drupal/Core/Extension/ModuleHandler.php

```php
public function invokeAll($hook, array $args = array()) {
  drupal_set_message("hook_$hook");
  ...
```

--vv--

# Modify forms
- Two popular hook:
  - hook_form_alter()
  - hook_form_FORMID_alter()
- Use hook_form_FORMID_alter() if possible.
- Use hook_form_alter() for dynamic form IDs.

--vv--

# Exercise
As a visitor I don't need an explanation for the Password field.

![Drupal login form](assets/images/drupal-login-form.png)

--vv--

# Exercise
As a visitor I don't need an explanation for the Password field.

- Remove the Password field description using hook_form_alter().
- More details in: /02 form alter/exercise.txt

--vv--

# Tips
- Core hooks: <br>http://api.drupal.org > Topics > Hooks
- Events are a good alternative for hooks. 
- A custom module can introduce its own hooks.
