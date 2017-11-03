<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\CargoRepositoryInterface;
use App\Repositories\CargoRepository;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register any domain services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CargoRepositoryInterface::class, CargoRepository::class);
    }
}