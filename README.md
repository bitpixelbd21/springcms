# SpringCMS - A Laravel based CMS

## Install;

`composer require bitpixel/springcms:dev-master`

`php artisan migrate`

`php artisan river:seed`

`php artisan river:cache-views`

To publish the assets(css, js files) into the public
directory, run:

`php artisan vendor:publish --tag=river-assets --force`

Run the following command to publish laravel-filemanager config && assets: 

`php artisan vendor:publish --tag=lfm_config --force`
`php artisan vendor:publish --tag=lfm_public --force`

This will generate `config/lfm.php`. Edit this file and set `use_package_routes` to `false`.

Update filesystem config: Open `config/filesystem.php` & change the public disk as follows:

```php
'public' => [
            'driver' => 'local',
            'root' => public_path('river/assets/files'),
            'url' => '/river/assets/files',
            'visibility' => 'public',
            'throw' => false,
        ],
```

Run the project: `php artisan serve`

Open admin panel: `localhost:8000/admin/login`

email: admin@gmail.com
password: 1234

### Package update route

Add the following route to the root project's `web.php` route file. This is used for during development to pull latest
code inside a shared hosting env.

```php
Route::get('/upd', function () {
    $git = new CzProject\GitPhp\Git;
    \File::deleteDirectory(base_path('vendor/rashidul/river'));
    $repo = $git->cloneRepository('https://github.com/rashidul-hasan/river.git', base_path('vendor/rashidul/river'));
    die('Done!');
});
```

### Errors

Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes ==> Fix: https://stackoverflow.com/a/42245921

Base table or view already exists: 105 ==> run `php artisan migrate:fresh`



### Development

1. Add the following param in root composer.json after "require" param
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
