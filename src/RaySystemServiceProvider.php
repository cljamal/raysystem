<?php
namespace CLJAMAL\RaySystem;

use CLJAMAL\RaySystem\Console\InstallCommand;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RaySystemServiceProvider extends ServiceProvider{

    protected $commands = [
        InstallCommand::class
    ];

    protected $routeMiddleware = [
        'ray.auth' => Middleware\Ray::class,
    ];

    protected $middlewareGroups = [
        'ray' => [
            'ray.auth'
        ]
    ];

    protected function registerConfig()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/ray.php', 'ray' );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ray');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ray');
        $this->compatibleBlade();
    }


    public function register()
    {
        $this->commands( $this->commands );
        $this->registerConfig();
        $this->registerRouteMiddleware();
        $this->registerRoutes();
    }

    /**
     * Remove default feature of double encoding enable in laravel 5.6 or later.
     *
     * @return void
     */
    protected function compatibleBlade()
    {
        $reflectionClass = new \ReflectionClass('\Illuminate\View\Compilers\BladeCompiler');

        if ($reflectionClass->hasMethod('withoutDoubleEncoding')) {
            Blade::withoutDoubleEncoding();
        }
    }


    /**
     * Register the default routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::namespace('\CLJAMAL\RaySystem\Controllers')
            ->prefix( config('ray.routes.admin-prefix') )
            ->middleware( config('ray.routes.middleware') )
            ->as( config('ray.routes.root-name') . '.' )
            ->group(function (Router $route){
            $route->get('/', 'AuthController@loginPage')->name('loginPage');
            $route->get('/auth/login',  '\\' . config('ray.auth.controller') . '@loginPage' )->name('loginPage');
            $route->post('/auth/login', '\\' . config('ray.auth.controller') . '@postLogin' )->name('postLogin');
        });
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
