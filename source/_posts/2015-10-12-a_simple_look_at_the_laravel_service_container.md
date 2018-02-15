---
title: A Simple Look at the Laravel Service Container
slug: Some Tips On How To Utilize Laravel's Service Container
url: a-simple-look-at-the-laravel-service-container
date: 2015-10-12
image: frank-mckenna-252014.jpg
image_link: https://unsplash.com/photos/tjX_sniNzgQ
photographer: Frank McKenna
---

Laravel comes out of the box with a powerful service container. This is the central hub of the framework that contains all the references to it's classes and libraries. It is the portion of Laravel that all dependency injection is resolved out of.

You may not realize it, but you use the service container all the time if you use Laravel to any extent. Anytime you make a call to `App::`, `app()`, or `$this->app` or any Facade, you are referencing the service container within Laravel.

Essentially, the service container is a versatile key-store. You can store anything you like within it. What makes it powerful is that you can tell the service container to perform whatever you want whenever a call to a certain key is made. Let's look at ways we can take advantage of the service container.

## Simple Binding

The simplest way to use the service container is to simply store a value in it:

```php
app()->bind('myAge', function(){
    return 27;
});

$my_age = app()->make('myAge');// 27
```

You could also do something like this:

```php
app()->bind('myAge', function (){
    return mt_rand(10, 40);
});

echo app()->make('myAge');// 24
echo app()->make('myAge');// 32
echo app()->make('myAge');// 18
```

## Singletons

But suppose we want to generate a random number only once and retrieve the number that was generated on each subsequent call? Laravel allows us to bind a shared value, meaning it will only resolve the closure once and return that value for each call:

```php
app()->bind('myAge', function (){
    return mt_rand(10, 40);
}, true);

echo app()->make('myAge');// 14
echo app()->make('myAge');// 14
echo app()->make('myAge');// 14
```

Notice the addition of the `true` parameter in the `bind()` call. We could also use the `singleton()` alias:

```php
app()->singleton('myAge', function (){
    return mt_rand(10, 40);
});

echo app()->make('myAge');// 10
echo app()->make('myAge');// 10
echo app()->make('myAge');// 10
```

Laravel will also pass the service container as an argument to your closure as well:

```php
app()->singleton('myAge', function(){
    return 27;
});

app()->singleton('myNextBirthday', function ($app){
    return $app->make('myAge') + 1;
});

echo app('myNextBirthday');//28
```

## Going A Little Deeper

But this is all just play. Let's really use what the container was made for: binding and resolving classes. Suppose we have a class `\App\Person`:

```php
namespace App;

class Person {

    public $age;
    public $gender;
    public $height;
    public $first_name;
    public $last_name;

    public function __construct($request){
        $this->age = $request->age;
        $this->gender = $request->gender;
        $this->height = $request->height;
        $this->first_name = $request->first_name;
        $this->last_name = $request->last_name;
    }
}
```

We want to create a person object whenever someone fills out a form. We could place this logic in some middleware or in a service provider or wherever it makes sense for your app:

```php
app()->singleton('visitor', function($app){
    return new \App\Person($app->make('request'));
});
```

And you can reference that object anywhere within your app:

```php
dd(app('visitor'));
/*
Person {
  age: "27"
  gender: "male"
  height: "73"
  first_name: "Patrick"
  last_name: "Stephan"
}
*/
```

## Other Goodies

Some other things that you can do that aren't well documented are

* determining if something has been bound to the container: `app()->bound('visitor')`
* determining if something has been resolved: `app()->resolved('visitor')`
* binding if it has not been bound yet: `app()->bindIf('myAge', function(){return 27;});`
* determine if an instance is shared: `app()->isShared('visitor')`
* retrieve all bindings: `getBindings()`
* clear out a resolved instance (force the container to call a shared closure/class again): `app()->forgetInstance('visitor')`

There are other things that you can do with the service container, but that is outside the scope of this post. Do some experimenting and read the source code. It will greatly improve your knowledge and ability.

That's it for today!