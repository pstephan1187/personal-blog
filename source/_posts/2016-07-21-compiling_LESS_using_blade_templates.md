---
title: Compiling LESS Using Blade Templates
slug: The power of Blade in LESS
url: compiling-LESS-using-blade-templates
date: 2016-07-21
image: alex-jodoin-246078.jpg
image_link: https://unsplash.com/photos/F0bx43QKhRA
photographer: Alex Jodoin
---

I am working on a large mult-tenant CMS at work. This CMS will host multiple sites, all with the ability to customize their own themes. Because of the dynamic nature of this system, using pre-compiled CSS won't work. It would greatly limit the customization that we could offer our clients. Therefore, the LESS files that we use in our themes must be compiled at runtime and then cached until a change is detected. The way that we have been doing that was to feed the main LESS file to a command line LESS compiler via PHP/Laravel and then return the resulting CSS.

I have recently come across a PHP package that compiles LESS and will compile strings, not just files. This gave me the bright idea of creating LESS files using blade templates, then compiling the processed blade files. This would allow for injection of template configurations directly into the CSS files. No more inline CSS!

The big thing in serving CSS this way is that you will either have to write the files to the public folder anytime there are changes, or you will need to serve them on the fly via a Controller. I chose the controller method. I will serve the CSS at `/assets/css/{filename}.css` where the filename is the filename (not including the '.less' extension) of the LESS file to pull in. My LESS files will be stored in `resources/assets/less/`. We will assume that I have a `main.less` file in the `resources/assets/less/` directory.

## Setting up our LESS Files

We will use bootstrap to visualize and text our progress. Let's pull it in:

```bash
npm install bootstrap --save
```

The source Bootstrap LESS files will be located in the `node_modules/bootstrap/less/` directory. Let's go ahead and import that into our main.less file:

```sass
@import "../../../node_modules/bootstrap/less/bootstrap";
```

We will want to put in some basic display on our welcome page so that we can see our changes being reflected in the CSS. Replace the contents of the `welcome.blade.php` file with the contents found in this gist: <a href="https://gist.github.com/pstephan1187/a57194ace35a8ce35d1257c0a457f954" target="_blank" rel="nofollow">https://gist.github.com/pstephan1187/a57194ace35a8ce35d1257c0a457f954</a>. This is a simplified version of one of the Bootstrap example templates. One major thing that you will notice is the CSS tag:

```html
<link href="/assets/css/main.css" rel="stylesheet">
```

That file will be process by our controller that we will setup. At this moment, if you were to visit the site (if you need help using Vagrant or Valet, reference the <a href="https://laravel.com/docs/valet" target="_blank" rel="nofollow">Laravel docs</a>) you would find a very ugly page. No worries, we will get that fixed soon enough.

## Setting up the Controller

The first thing we need to do is to set up the route

```php
Route::get('assets/css/{filename}.css', 'AssetController@getCSS');
```

Before we create the controller, we will need to pull in our LESS Processor package. The package that I utilized is <a href="https://github.com/oyejorge/less.php" target="_blank" rel="nofollow">oyejorge/less.php</a>. I installed it via composer:

```bash
composer require oyejorge/less.php
```

Once that is pulled in we can work on serving our compiled CSS. We will need to create our controller. That can be done with Artisan (We use the `--plain` flag to give us an empty controller as opposed to a resource controller.):

```bash
php artisan make:controller AssetController --plain
```

We won't process any blade files just yet. We want to make sure that we get our compiler working in it's most simplest form first. We will need to reference our new package before we can use it. Once we add it our controller should look like this:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Less_Parser;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    //
}
```

## Compiling the LESS Files

Now we can create our `getCss` method:

```php
public function getCss($less_file)
{
    $file_path = base_path().'/resources/assets/less';
    $file_name = $file_path.'/'.$less_file.'.less';
    $parser = new Less_Parser();
    $parser->parseFile($file_name);
    $compiled_css = $parser->getCss();

    return response($compiled_css)->header('Content-Type', 'text/css');
}
```

Let's go through each line to discuss what is happening:

1. We need to get the full path to the location of the LESS file.
2. We will take the referenced LESS file and append it to our file path and tack on the `.less` extension
3. We will instantiate a new instance of our LESS Parser.
4. We will process the LESS
5. We will retrieve the compiled CSS
6. We return the contents and apply the appropriate MIME type.

If you open the `assets/css/main.css` file in your browser, you will see the compiled CSS. If you open your welcome page, you will see properly styled Bootstrap elements. Good Job!

Let's change some of the colors and see if it updates properly. In your `main.less` file, add the following below your bootstrap import statement:

```sass
@brand-primary:         blue;
@brand-success:         green;
@brand-info:            purple;
@brand-warning:         orange;
@brand-danger:          red;

@state-success-text:             @brand-success;
@state-success-bg:               lighten(@brand-success, 30%);
@state-success-border:           @brand-success;

@state-info-text:             @brand-info;
@state-info-bg:               lighten(@brand-info, 30%);
@state-info-border:           @brand-info;

@state-warning-text:             @brand-warning;
@state-warning-bg:               lighten(@brand-warning, 30%);
@state-warning-border:           @brand-warning;

@state-danger-text:             @brand-danger;
@state-danger-bg:               lighten(@brand-danger, 30%);
@state-danger-border:           @brand-danger;
```

Now refresh your homepage. Shew buddy! Them's some bright colors. It doesn't necessary look great, but we're able to override the Bootstrap defaults. Go ahead and play around with the variables if you'd like. When you're ready, let's move on to get it working with Blade!

## Compiling Blade Templates as LESS

First, let's rename the `main.less` file to `main.blade.php`. Then, we will need to update our controller's `getCss` method:

```php
public function getCss($less_file)
{
    $file_path = base_path().'/resources/assets/less';
    $file_name = $file_path.'/'.$less_file.'.blade.php';
    $less_contents = view()->file($file_name)->render();

    $parser = new Less_Parser();
    $parser->SetImportDirs([
        base_path() => base_path(),
        $file_path => $file_path
    ]);
    $parser->parse($less_contents);
    $compiled_css = $parser->getCss();

    return response($compiled_css)->header('Content-Type', 'text/css');
}
```

What have we done here?

 - We've updated the $file_name to import the blade file now.
 - We are parsing the blade file and storing the contents to `$less_contents`.
 - Since we are not parsing a LESS file, we need to tell the LESS parser what directories to check for `@import` statements.
 - We've updateded the `parse` command to parse contents instead of a file.

Refreshing your homepage should show no changes, which means everything is working. Yay, us! Now this is where the real power comes it. You have all the power of Blade and PHP within any blade file that you are parsing with less. You also can `@include` additional Blade files that contain more LESS just like you would `@import` other LESS files.
 
> If the location of any blade files you are including are not in your default `views` directory, you may need to add a path for the Blade parser to search: `view()->addLocation($path);`
 
Let's test it out real quick. We will create a few variables in our controller and see if they work in our Blade LESS file. Add the following property to the controller:
 
```php
protected $colors = [
    'primary' => '336699',
    'success' => '339966',
    'info' => '663399',
    'warning' => '669933',
    'danger' => '996633'
];
 ```
 
Then update the `$less_contents = view()->file($file_name)->render();` line to `$less_contents = view()->file($file_name, $this->colors)->render();`. Then update the following lines in the `main.blade.php` file:

```sass
@brand-primary:         #{{ $primary }};
@brand-success:         #{{ $success }};
@brand-info:            #{{ $info }};
@brand-warning:         #{{ $warning }};
@brand-danger:          #{{ $danger }};
```

Refreshing your homepage will show that the PHP variables are now being process in your CSS. I am sure you are now thinking of numerous ways to take advantage of this new found power. You could use `@if` statements to render out certain portions of CSS only under certain circumstances, for example.

## Caching

It is up to you to find the appropriate method for caching the compiled CSS. The best method will vary from scenario to scenario. The LESS Parser package includes it's own caching mechanism, but when using a large number of files (like those required for Bootstrap) I have found that it is not any quicker than just recompiling the LESS. In my setup, there is an admin section where users can change the settings for their template. When the settings are changed, the cache is cleared. Then the next time the CSS is requested, it gets processed and cached for a week. This can reduce the round trip time for the CSS from 1.5 seconds to under 0.3. I also pass cache headers back to the browser wich keeps the browser from even requesting the CSS, which makes the site super fast.

I hope you found this useful and beneficial. If you have any questions, feel free to leave a comment below.