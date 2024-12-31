---
sidebar_position: 1
---

# Installation

1. Install the package: 
```bash
composer require bitpixel/springcms:dev-master
```

1. Remove the default home route from `routes/web.php`. We will use the route that is defined in our package.

1. This package uses the (https://github.com/UniSharp/laravel-filemanager)[https://github.com/UniSharp/laravel-filemanager] package to manage images. Run the following command to publish laravel-filemanager config && assets: 

```bash
php artisan vendor:publish --tag=lfm_config --force
```

```bash
php artisan vendor:publish --tag=lfm_public --force
```

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
