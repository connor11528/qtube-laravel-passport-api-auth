Laravel 5 API
====

The intial steps are to create a brand spanking new Laravel 5.5 application. This takes some configuration on your machine such as installing PHP and MySQL. 

Source code available [on Github](https://github.com/connor11528/authenticated-api-with-laravel-5).

## Helpful tutorial series

Part 1 - [Database seeding](http://www.qcode.in/advance-interactive-database-seeding-in-laravel/)

Part 2 - [REST API with Laravel Passport](http://www.qcode.in/create-rest-api-authentication-using-laravel-passport/)

Part 3 - [Add Vue.js frontend](http://www.qcode.in/youtube-like-app-vue-js-laravel/)

## What is an API?

An API stands for application programming interface. They are very popular because they generally conform to a standard called JSON. APIs allow web applications to easily communicate with each other via HTTP requests. In this application we're going to have JSON endpoints that anyone can send requests to and get data back from. However, we'd like to protect our data so that only people sending requests that have security tokens see the JSON. Everyone else will see error messages saying please authenticate.

## What is Laravel?

Laravel is a badass PHP web development framework. If you're learning to code, learn the basics about variables and for loops, study a bit of Javascript and then when you're ready to set up servers and databases (about week 2) learn Laravel. [Laracasts](https://laracasts.com/) is your friend. You can browse most of the Laravel tutorials I've written [here](http://connorleech.info/categories/Laravel/).

## What is Passport?

[Laravel Passport](https://laravel.com/docs/5.5/passport) is a PHP package for Laravel that helps to secure your APIs. It implements best practices defined by the OAuth2 standard and is built on top of the popular thephpleague/oauth2-server codebase. Passport uses Json Web Tokens (JWT) for token encryption. It is a core package of the Laravel PHP framework since the 5.3 release in September 2016. 

## How do I get set up?

Create a fresh Laravel application and install passport via composer. You'll have to run migrations and `php artisan passport:install`. There are also some files to modify in order to configure the server. These steps are outlined in the documentation and about every single Laravel Passport tutorial on the internet so I will not recite them here. You can find the code changes for setting up Passport within [this commit](https://github.com/connor11528/authenticated-api-with-laravel-5/commit/ad6151eb71bdc99da88f7e96e8856c9fef2a35e0).

## What is Middleware? 

We can use Passport from our controller by invoking Middleware. Middleware is a way to filter requests that are incoming to your application. It is not specific to Laravel, nearly every web development framework in 2018 has some concept of middleware for HTTP requests. Middleware gets executed before the controller method; it sits in the middle between the user making a request and the logic to execute that request. 

As an example, a user could send a POST request to `http://mysite.com/api/deleteAllTheInfoFromTheDatabase` from the browser, terminal or Postman. If we, for whatever reason have that horrific endpoint set up within our application, middleware could protect us. Before executing the controller method to delete data the request could first be filtered through middleware and checked that whoever is making the request has permission to delete everything. 

Taylor Otwell, the creator of Laravel, wrote in an authentication gaurd to Passport that can be invoked within a route definition like so:

```
Route::post('/api/deleteAllTheInfoFromTheDatabase', function () {

    // delete logic goes here

})->middleware('auth:api');
```

The code above specifies that we'd like to use the `auth` middleware in conjunction with the `api` Gaurd for the delete everything route endpoint. 

> As a side note, if you'd actually like bulk delete functionality in your application consider implementing it through a [custom Artisan command](https://laravel.com/docs/5.5/artisan#writing-commands) instead of an HTTP endpoint.

We can also specify that we'd like middleware to be invoked for every method on a controller by defining it within the controller's constructor method like so:

```
class ExampleController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth:api');
	}

	// controller methods go here
}
```

This code will run the auth middleware and check the api gaurd before executing any method defined in ExampleController. To have the middleware run only for specific method calls we could use only: `$this->middleware('auth:api', [ 'only' => ['store', 'destroy', 'update'] ]);`. To run the middleware for everything except certain methods use except: `$this->middleware('auth:api', [ 'except' => ['index', 'show'] ]);`.  

## What is an Authentication Gaurd?

Let's back up a bit. What the heck is an authentication gaurd?

Passport includes an authentication gaurd that will validate access tokens for incoming requests. In the initial Passport setup I modified **config/auth.php** to use the passport provider. That file looks like this:

```
    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
```

Laravel provides helpful comments for all configuration options.


