# Drupal 7 versus 8

--vv--

# 7 versus 8: changes
- Drupal 8 is a full rewrite. Size 470% increased.
- Proudly found elsewhere: Symfony, Composer, PhpUnit, Guzzle, Twig, Yaml format, etc.
- Fewer structures, Object Oriented.
- Less Drupal-isms
- Info hooks replaced. Procedural API functions changed to services or static methods.
- New: Configuration, Plugins, Routing, Caching, Services, Events, Annotations.

--vv--

# 7 versus 8: changes
- Dependencies are now explicit.
  - css, js, modules, configuration
- Use objects instead of array values.
  - Interfaces, methods, typed objects
  - Less debug() and field_name['und'][0]['value']
  - More xdebug

--vv--

# 7 versus 8: unchanged
- Concepts of entities, blocks, users, comments, etc.
- Alter hooks, form API, theming layer.
- Database layer.
- Many procedural functions are remaining.
