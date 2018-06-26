# Caching

--vv--

# Caching
<!-- .slide: style="text-align: center"-->

>There are only two hard things in Computer Science: <br>cache invalidation and naming things.

Phil Karlton

--vv--

# Cache strategies
- Compile to PHP: Twig templates
- Pluggable cache backend: Database, APC, Memory.
- Cache chain
- #cache and placeholder
- Advanced cache invalidation

--vv--

# Cache terminology
- **tags**: Identifiers of rendered content. Used for cache invalidation. <br>Example: node:42, user_view, config:image.style.large
- **contexts**: Contexts by which the content may vary. <br>Example: `language`, `user.roles:<role>`
- **max-age**: The maximum time cached content is valid. Defaults to permanent.

--vv--

# Cache

```php
class AuthorNameFormatter extends FormatterBase {

  public function viewElements(FieldItemListInterface $items) {
    $elements = array();

    foreach ($items as $delta => $item) {
      /** @var $comment \Drupal\comment\CommentInterface */
      $comment = $item->getEntity();
      $account = $comment->getOwner();
      $elements[$delta] = array(
        '#theme' => 'username',
        '#account' => $account,
        '#cache' => array(
          'tags' => $account->getCacheTags() + $comment->getCacheTags(),
        ),
      );
    }
```

Inherits cache tags from account and comment.

--vv--

# Cache

```php
# \Drupal\user\AccountForm

abstract class AccountForm extends ContentEntityForm {

  public function form(array $form, FormStateInterface $form_state) {
   /** @var \Drupal\user\UserInterface $account */
    $account = $this->entity;
    $user = $this->currentUser();
    $config = \Drupal::config('user.settings');
    $form['#cache']['tags'] = $config->getCacheTags();
```

Inherits cache tags from user settings.

--vv--

# Cache

```php
# \Drupal\comment\CommentForm

class CommentForm extends ContentEntityForm {

  public function form(array $form, FormStateInterface $form_state) {

    // In several places within this function, we vary $form on:
    // - The current user's permissions.
    // - Whether the current user is authenticated or anonymous.
    // - The 'user.settings' configuration.
    // - The comment field's definition.
    $form['#cache']['contexts'][] = 'user.permissions';
    $form['#cache']['contexts'][] = 'user.roles:authenticated';
    $this->renderer->addCacheableDependency($form, $config);
    $this->renderer->addCacheableDependency($form, $field_definition->getConfig($entity->bundle()));
```

Inherits cache settings from user roles and permission, form config and field config.

--vv--

# Cache Context
- A string that refers to a cache context services.

```yaml
languages
  :type
route
  .menu_active_trails
    :menu_name
  .name
timezone
user
  .is_super_user
  .permissions
  .roles
    :role
```

https://www.drupal.org/developing/api/8/cache/contexts

--vv--

# Exercise
As a visitor I want to see the Recent games block regularly updated when reviews are updated or new ones added.

- Use #cache settings to invalidate the cache when nodes are updated.
- Make sure the block is also updated when games are added.
- More exercise details in: _/06 caching/exercise.php_.

--vv--

# Tips
- To make a route response not cachable, add the option `no_cache: TRUE`
- Debug Cache-Tags and Cache-Contexts in http header: <br>in sites/*/service.yml `http.response.debug_cacheability_headers: true`
- Documentation
  - https://drupal.org/developing/api/8/cache
  - http://drupal.org/developing/api/8/render/arrays/cacheability
