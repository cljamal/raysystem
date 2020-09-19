<?php
namespace CLJAMAL\RaySystem;

use CLJAMAL\RaySystem\Console\InstallCommand;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RaySystemServiceProvider extends ServiceProvider{

    protected $commands = [
        InstallCommand::class
    ];

    protected $routeMiddleware = [
        'ray.auth'       => Middleware\Ray::class,
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

    public function register()
    {
        $this->commands( $this->commands );
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ray');
        $this->registerConfig();
        $this->registerRouteMiddleware();
        $this->registerRoutes();
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
