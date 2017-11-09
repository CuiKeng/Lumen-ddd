<?php

namespace App\Provider;

use Illuminate\Support\ServiceProvider;
use App\Domain\Cargo\CargoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register any domain services.
     *
     * @return void
     */
    public function register()
    {
//         $this->app->singleton(CargoRepositoryInterface::class, \App\Persistence\Custom\CargoRepository::class);
        $this->app->singleton(CargoRepositoryInterface::class, function ($app) {
            return $app->make(EntityManagerInterface::class)->getRepository(\App\Domain\Cargo\Cargo::class);
        });
    }
}