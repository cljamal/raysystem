<?php
namespace CLJAMAL\RaySystem;

use CLJAMAL\RaySystem\Console\InstallCommand;
use CLJAMAL\RaySystem\Middleware\{
    RayEncryptCookies,
    RayAddQueuedCookiesToResponse,
    RayStartSession,
    RayShareErrorsFromSession,
    RayVerifyCsrfToken,
    RaySubstituteBindings,
    RayMiddleware,
};
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RaySystemServiceProvider extends ServiceProvider{

    protected $commands = [
        InstallCommand::class
    ];

    protected $routeMiddleware = [
        'ray.auth'                           => RayMiddleware::class,
        'ray.encrypt-cookies'                => RayEncryptCookies::class,
        'ray.add-queued-cookies-to-response' => RayAddQueuedCookiesToResponse::class,
        'ray.start-session'                  => RayStartSession::class,
        'ray.errors-share'                   => RayShareErrorsFromSession::class,
        'ray.csrf'                           => RayVerifyCsrfToken::class,
        'ray.substituteBindings'             => RaySubstituteBindings::class,
    ];

    protected $middlewareGroups = [
        'ray' => [
             'ray.encrypt-cookies',
             'ray.add-queued-cookies-to-response',
             'ray.start-session',
             'ray.errors-share',
             'ray.csrf',
             'ray.substituteBindings',
             'ray.auth',
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
    }


    public function register()
    {
        $this->commands( $this->commands );
        $this->registerConfig();
        $this->registerGuard();
        $this->registerRouteMiddleware();
        $this->registerRoutes();
    }

    public function registerGuard()
    {
        $this->app['config']->set('auth.guards.ray', config('ray.auth.guards.ray'));
        $this->app['config']->set('auth.providers.ray', config('ray.auth.providers.ray'));
    }



    /**
     * Register the default routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $namespace = '\CLJAMAL\RaySystem\Controllers';

        Route::namespace( $namespace )->prefix( config('ray.routes.admin-prefix') )->middleware( config('ray.routes.middleware') )->as( config('ray.routes.root-name') . '.' )->group(function (Router $route){
            $route->get('/', 'DashController@index')->name('index');


            $route->get('/auth/login',  '\\' . config('ray.auth.controller') . '@pageLogin' )->name('page-login');
            $route->post('/auth/login', '\\' . config('ray.auth.controller') . '@postLogin' )->name('post-login');
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
