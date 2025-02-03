<?php

namespace BitPixel\SpringCms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use BitPixel\SpringCms\Commands\CacheViewFilesCommand;
use BitPixel\SpringCms\Commands\DatabaseSeederCommand;
use BitPixel\SpringCms\Commands\Generators\MakeControllerCommand;
use BitPixel\SpringCms\Commands\Generators\MakeMigrationCommand;
use BitPixel\SpringCms\Commands\Generators\MakeModelCommand;
use BitPixel\SpringCms\Commands\Generators\MakeViewFilesCommand;
use BitPixel\SpringCms\Commands\Generators\ScaffoldCommand;
use BitPixel\SpringCms\Http\Middleware\AccessTokenMiddleware;
use BitPixel\SpringCms\Http\Middleware\Authenticate;
use BitPixel\SpringCms\Http\Middleware\CheckIfInstalled;
use BitPixel\SpringCms\Http\Middleware\CheckRole;
use BitPixel\SpringCms\Http\Middleware\RedirectIfAuthenticated;
use BitPixel\SpringCms\Http\Middleware\RedirectIfInstalled;
use BitPixel\SpringCms\Models\Admin;
use BitPixel\SpringCms\Models\Customer;
use BitPixel\SpringCms\ViewComposers\AdminSidebarViewComposer;

class SpringCmsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureAuthGuards();

        $this->configureMiddlewares();

        $this->configureRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'river');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../public' => public_path('springcms'),
        ], 'springcms-assets');


        //viewcomposers
        View::composer('river::admin.layouts.sidebar', AdminSidebarViewComposer::class);

        //blade components
        Blade::component('river::header', 'header');

        $this->configureCommands();
    }

    private function configureAuthGuards(): void
    {
        $this->app['config']->set('auth.guards.admins', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);
        $this->app['config']->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ]);
        $this->app['config']->set('auth.guards.customers', [
            'driver' => 'session',
            'provider' => 'customers',
        ]);
        $this->app['config']->set('auth.providers.customers', [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]);
    }

    private function configureMiddlewares(): void
    {
        $this->app['router']->aliasMiddleware('river.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('river.guest', RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('river.checkrole', CheckRole::class);
        $this->app['router']->aliasMiddleware('river.checkIfInstalled', CheckIfInstalled::class);
        $this->app['router']->aliasMiddleware('river.redirectIfInstalled', RedirectIfInstalled::class);
        $this->app['router']->aliasMiddleware('river.access_token', AccessTokenMiddleware::class);
    }

    private function configureRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/site.php');
    }

    private function configureCommands(): void
    {
        $this->commands([
            CacheViewFilesCommand::class,
            DatabaseSeederCommand::class,
            MakeMigrationCommand::class,
            MakeViewFilesCommand::class,
            ScaffoldCommand::class,
            MakeControllerCommand::class,
            MakeModelCommand::class
        ]);
    }
}
