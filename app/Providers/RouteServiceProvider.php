<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapAuthRoutes();
        $this->mapWebRoutes();
        $this->mapBackendRoutes();
        if (App::environment(['local', 'testing']))
            $this->mapDevRoutes();
    }

    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.'\Front')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "dev" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDevRoutes()
    {
        Route::prefix('dev')
            ->middleware('web')
            ->namespace('App\Http\Controllers\Dev')
            ->group(base_path('routes/dev.php'));
    }

    /**
     * Define the "backend" routes for the application.
     *
     * These routes all receive session state, CSRF protection, Auth, etc.
     *
     * @return void
     */
    protected function mapBackendRoutes()
    {
        Route::prefix('dashboard')
        ->middleware('web','auth','dashboard.access')
            ->namespace('App\Http\Controllers\Back')
            ->group(base_path('routes/backend.php'));
    }
}
