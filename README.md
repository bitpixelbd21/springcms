# SpringCMS - A Laravel based CMS

## Install

1. Install the package: `composer require bitpixel/springcms:dev-master`

1. Remove the default home route from `routes/web.php`. This route is defined in our package

1. This package uses the (https://github.com/UniSharp/laravel-filemanager)[https://github.com/UniSharp/laravel-filemanager] package to manage images. Run the following command to publish laravel-filemanager config && assets: 

`php artisan vendor:publish --tag=lfm_config --force`

`php artisan vendor:publish --tag=lfm_public --force`

This will generate `config/lfm.php`. Edit this file and set `use_package_routes` to `false`.

Update filesystem config: Open `config/filesystem.php` & change the public disk as follows:

```php
'public' => [
            'driver' => 'local',
            'root' => public_path('/uploads/files'),
            'url' => '/uploads/files',
            'visibility' => 'public',
            'throw' => false,
        ],
```
4. Run the project using `php artisan serve` && open the project in your browser. It should redirect to the `/install` route. Complete the installation process by following the steps.


### Package update route

Add the following route to the root project's `web.php` route file. This is used for during development to pull latest
code inside a shared hosting env.

```php
Route::get('/upd', function () {
    $git = new CzProject\GitPhp\Git;
    \File::deleteDirectory(base_path('vendor/bitpixel/springcms'));
    $repo = $git->cloneRepository('https://github.com/bitpixelbd21/springcms.git', base_path('vendor/bitpixel/springcms'));
    die('Done!');
});
```

### Errors

Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes ==> Fix: https://stackoverflow.com/a/42245921

Base table or view already exists: 105 ==> run `php artisan migrate:fresh`



### Development

1. Add the following param in root composer.json after "require" param, then run `composer require bitpixel/springcms:dev-master`
```js
"repositories": [
    {
    "type": "path",
    "url": "./package/river",
    "options": {
        "symlink": true
    }
    }
], 

```

Error: ` curl error 60 while downloading https://repo.packagist.org/p2/bitpixel/springcms.json: SSL certificate problem: unable to get local issuer certificate`

to fix this run: `composer config -g -- disable-tls false`
