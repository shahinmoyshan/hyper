# Hyper PHP Framework

**Sweet and MVT Based PHP Tiny Web Framework**

Hyper is a lightweight and easy-to-use PHP framework based on the Model-View-Controller (MVC) architecture. It is designed to be simple yet powerful, providing an efficient foundation for building modern web applications.

## Installation

To install HyperPhp, Use [Composer](https://getcomposer.org/) to install it (Recommended):

```sh
composer create-project vulcanphp/hyper myapp
```

or Clone the Repository
```sh
# Clone HyperPhp
git clone https://github.com/vulcanphp/hyper.git

# Install Dependencies
composer install
```
**Application Key**: 
The next thing you should do after installing HyperPhp *(Without Using Composer)* is set your application key to a random string. Typically, this string should be 32 characters long. The key can be set in the env.php file. If you have not renamed the env.example.php file to env.php, you should do that now. If the application key is not set, your user encrypted data will not be secure!

### Server Requirements

The HyperPhp framework has a few system requirements. You will need to make sure your server meets the following requirements:
- PHP >= 8.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

### Serving Your Application

To serve your project locally, you may use the Laravel Herd, or the built-in PHP development server:

```sh
php -S localhost:8000 -t public
```


## The Basics

### Basic Routing
You will define all of the routes for your application in the *routes/web.php* file. The most basic HyperPhp routes simply accept a URI and a *Closure*:
```php
router()->get('foo', function () {
    return 'Hello World';
});

router()->post('foo', function () {
    //
});
```

### Available Router Methods
The router allows you to register routes that respond to any HTTP verb:
```php
router()->get($uri, $callback);
router()->post($uri, $callback);
router()->put($uri, $callback);
router()->patch($uri, $callback);
router()->delete($uri, $callback);
router()->any($uri, $callback);
router()->options($uri, $callback);
router()->view($uri, $callback);
```

### Route Parameters
#### Required Parameters
Of course, sometimes you will need to capture segments of the URI within your route. For example, you may need to capture a user's ID from the URL. You may do so by defining route parameters:

```php
router()->get('user/{id}', function ($id) {
    return 'User '.$id;
});
```
You may define as many route parameters as required by your route:

```php
router()->get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    //
});
```
### Named Routes
Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route using the *->name()* function when defining the route:
```php
router()->get('/profile', $callback)->name('profile');
```

#### Generating URLs To Named Routes
Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via the global *route_url* function:
```php
// Generate a Basic Route Url
$url = route_url('profile');

// Generate a Named Route Url
$url = route_url('post.comment', ['postId' => 1, 'commentId' => 2]);
```

### Route Groups
Route groups allow you to share route attributes, such as path, middleware, name, method, callback across a large number of routes without needing to define those attributes on each individual route. Shared attributes are specified in an array format as the first parameter to the *router()->group* method.

```php
router()->group(['middleware' => ['csrf'], 'path' => '/admin'], function($router) {
  $router->get('/dashboard', [AdminController::class, 'dashboard');
  // ...
});
```

#### Available Grouping Roues Attributes:
- middleware e.x, ['middleware' => ['csrf', 'auth']]
- path e.x, ['path' => '/admin']
- method e.x, ['method' => ['get', 'post']]
- name e.x, ['name' => 'admin.']
- callback e.x, ['callback' => AdminController::class]
- template e.x, ['template' => 'app']

### HTTP Middleware

HTTP middleware provide a convenient mechanism for filtering HTTP requests entering your application. Middleware can be written to perform a variety of tasks. A CORS middleware might be responsible for adding the proper headers to all responses leaving your application. A csrf middleware might verify postback incoming requests to your application.

All middleware should be stored in the *app/Http/Middlewares* directory.

```php
<?php

namespace App\Http\Middlewares;

use Hyper\Request;

class AuthMidleware
{
    /**
     * Run the request filter.
     *
     * @param  \Hyper\Request  $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        if (is_quest()) {
            return redirect('/login');
        }
    }
}

```

#### Registering Middleware
If you want a middleware to be run during every HTTP request to your application, simply list the middleware class in the *bootstrap/middlewares.php* file:
```php
<?php

/**
 * Middleware configuration.
 *
 * This file returns an array of middleware classes used by the application.
 * Each middleware is associated with a key that can be used to reference it.
 * 
 * @return array
 *   An associative array of middleware keys and their corresponding class names.
 */
return [
    'auth' => \App\Http\Middlewares\AuthMiddleware::class,
    // ...
];

```

#### Assigning Middleware To Routes
Once the middleware has been defined in the *bootstrap/middlewares.php*, you may use the middleware key in the route:
```php
router()->get('admin/profile', [AdminController::class, 'profile'])->middleware('auth');
```
You may use an array to assign multiple middleware to the route:
```php
router()->get('admin/profile', [AdminController::class, 'profile'])->middleware(['auth', 'super']);
```

Or Attach the middleware in Grouped Route
```php
router()->group(['middleware' => ['auth']], function() {
  router()->get($uri, $callback);
});
```

### HTTP Controllers
Instead of defining all of your request handling logic in a single *routes/web.php* file, you may wish to organize this behavior using Controller classes. Controllers can group related HTTP request handling logic into a class. Controllers are stored in the *app/Http/Controllers* directory.

#### Basic Controllers
Here is an example of a basic controller class:
```php
<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin/user', ['user' => $user]);
    }
}
```
We can route to the controller action like so:
```php
use App\Http\Controllers\UserController;

router()->get('user/{id}', [UserController::class, 'show']);
```

Now, when a request matches the specified route URI, the *show* method on the *UserController* class will be executed. Of course, the route parameters will also be passed to the method.


### Dependency Injection & Controllers
#### Constructor Injection
The HyperPhp service container is used to resolve all controllers. As a result, you are able to type-hint any dependencies your controller may need in its constructor. The dependencies will automatically be resolved and injected into the controller instance:

```php
<?php

namespace App\Http\Controllers;

use App\Lib\Auth;

class UserController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(private Auth $auth)
    {
    }
}
```

#### Method Injection
In addition to constructor injection, you may also type-hint dependencies on your controller's action methods. For example, let's type-hint the *Hyper\Request* instance on one of our methods:

```php
<?php

namespace App\Http\Controllers;

use Hyper\Request;

class UserController
{
    /**
     * Store a new user.
     *
     * @param  Request   $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(['name' => 'required']);

        //
    }
}
```

If your controller method is also expecting input from a route parameter, simply list your route arguments after your other dependencies. For example, if your route is defined like so:

```php
router()->put('user/{id}', [UserController::class, 'update']);
```

You may still type-hint the *Hyper\Request* and access your route parameter id by defining your controller method like the following:
```php
<?php

namespace App\Http\Controllers;

use Hyper\Request;

class UserController
{
    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
```
