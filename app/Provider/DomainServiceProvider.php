<?php

namespace App\Provider;

use Illuminate\Support\ServiceProvider;
use App\Contract\Repository\CargoRepositoryInterface;
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
//         $this->app->singleton(CargoRepositoryInterface::class, \App\Repository\CargoRepository::class);
        $this->app->singleton(CargoRepositoryInterface::class, function ($app) {
            return $app->make(EntityManagerInterface::class)->getRepository(\App\Domain\Cargo\Cargo::class);
        });
    }
}