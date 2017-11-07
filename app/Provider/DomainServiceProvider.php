<?php

namespace App\Provider;

use Illuminate\Support\ServiceProvider;
use App\Contract\Repository\CargoRepositoryInterface;
use App\Repository\CargoRepository;

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