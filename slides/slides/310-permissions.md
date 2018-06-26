# Permissions

--vv--

# Permissions
- Permissions defined by modules.
- Defined in: MODULE.permissions.yml
- AccountInterface::hasPermission()
- Build-in into routing.
- user/1 has all privileges.

--vv--

# Permissions

```yaml
# book.routing.yml
book.admin:
  path: '/admin/structure/book'
  defaults:
    _controller: '\Drupal\book\Controller\BookController::adminOverview'
    _title: 'Books'
  requirements:
    _permission: 'administer book outlines'
``` 

```yaml
# book.permissions.yml
administer book outlines:
  title: 'Administer book outlines'
``` 

```yaml
# special requirements
   _permission: 'administer rules+administer rules reactions'
   _custom_access: '\Drupal\menu_ui\Form\MenuLinkResetForm::linkIsResettable'
   _access: 'TRUE'
``` 

https://www.drupal.org/docs/8/api/routing-system/access-checking-on-routes

--vv--

# Best practices
- Determine rolles and permissions in an early stage of development.
- Re-use existing permissions if possible.
- Apply access control as early in the process as possible (e.g. in route).

