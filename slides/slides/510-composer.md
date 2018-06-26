# Composer

--vv--

# Composer
- PHP Package Manager
- Repository index at packagist.org
- Drupal Composer project template <br>https://github.com/drupal-composer/drupal-project
  - Apply patches.
  - Vendor directory outside of Drupal root.
  - Custom repository for e.g. company modules
- Recursively handles child dependencies

--vv--

# Composer
- Configuration in composer.json
- Do (not) commit vendor directory in Git repo.
- Popular commands
  - `composer install`
  - `composer install --no-dev`
  - `composer require drupal/extra_field`
  - `composter update drupal/core:~8.3.7`
- Run from project root
