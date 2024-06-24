<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MeterRepository;

class MeterRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MeterRepository::class, function ($app) {
            return new MeterRepository();
        });
    }
}
