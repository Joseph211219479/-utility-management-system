<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MeterReadingRepository;
use Illuminate\Support\Facades\Route;


class MeterReadingRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MeterReadingRepository::class, function ($app) {
            return new MeterRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Register the middleware alias
        $router = $this->app['router'];
        $router->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

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
}
