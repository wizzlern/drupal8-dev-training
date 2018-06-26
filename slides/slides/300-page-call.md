# Page call

--vv--

# Page call

![Page call diagram](assets/images/page-call-diagram.png)

- **Router** determines what should respond to the request. e.g. Page callback
- **Controller** builds the response for a given request. e.g. Render Array
- **View** creates the right type of output that matches the request. e.g. Renders to HTML.

--vv--

# Page call
- Request object represents HTTP request.
- Response object represents the response.
- Uses events to allow other processes to add/modify data
- Code:
  - bootstrap.inc: drupal_handle_request()
  - Symfony\Component\HttpKernel::handleRaw()

--vv--

# Route definition
```php
# demo_routing.routing.yml

# Static routes
demo_routing.info:
  path: '/demo/routing'
  defaults:
    _controller: '\Drupal\demo_routing\Controller\DemoRoutingController::infoPage'
    _title: 'Routing'
  requirements:
    _permission: 'access content'

# Dynamic routes
route_callbacks:
  - '\Drupal\demo_routing\Routing\DemoRoutes::routes'
```

--vv--

# Route controller

```php
namespace Drupal\demo_routing\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Events Demo module routes.
 */
class DemoRoutingController extends ControllerBase {

  /**
   * Controller content callback: Info page.
   *
   * @return array
   */
  public function infoPage() {
    $output['hello'] = array(
      '#markup' => 'Quick and dirty text',
    );
    return $output;
  }
}
```

--vv--

# Exercise
As a logged in user I want to have a page that lists all available games reviews that match my age.

- Create a page with a list of game review teasers at 
- URL '/games'.
- More exercise details in: _/05 page/.../WizzlernPegiController.php_.

--vv--

# Request object
- **Request object** = Representation of the (HTTP) request.
- Contains request data, header data, session data, get/post parameters, etc.
- Class: \Symfony\Component\HttpFoundation\Request

```php
$request = \Drupal::request();
$get_q = $request->query->get('q');
$post_name = $request->request->get('name');
$client_ip = $request->getClientIp();
$mycookie = $request->cookies->get('mycookie');
$system_path = $request->attributes->get('_system_path');
$session = $request->getSession();
$value = $session->get('mymodule_count', 0);
``` 

Added request attributes start with '_'.

--vv--

# Response object
- **Response object** = Representation of the response.
- Contains response data, headers, etc.
- Types: Response, RedirectResponse, AjaxResponse, CacheableResponse, etc.

```php
$response = new Response($e->getMessage(), $e->getStatusCode());
$response->prepare($request)->send();
$response->setStatusCode(500, '500 Service unavailable (with message)');
$response = new RedirectResponse($base_url . '/' . $path, 302, $headers);
$response->headers->add($default_headers);

$response = new AjaxResponse();
$response->setAttachments($form['#attached']);
$response->addCommand(new CloseModalDialogCommand());
```

--vv--

# Notes
- http://symfony.com/doc/current/book/http_fundamentals.html 
- Underlying functionality of the routing system https://www.drupal.org/node/2046371
