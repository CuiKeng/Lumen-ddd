<?php

namespace App\Provider;

use Illuminate\Support\ServiceProvider;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\DBAL\Types\Type;
use App\Persistence\Doctrine\Type\CargoItineraryLegsType;
use App\Persistence\Doctrine\Type\CargoTrackingIdType;

class DoctrineServiceProvider extends ServiceProvider
{
    /**
     * Register any domain services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EntityManagerInterface::class, function ($app) {
            return EntityManager::create([
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '',
                'dbname' => 'domain-lumen',
                'charset' => 'utf8mb4'
            ], Setup::createXMLMetadataConfiguration([app()->path() . '/Persistence/Doctrine/ORM']));
        });
        
        if (! Type::hasType(CargoItineraryLegsType::TYPE_NAME)) {
            Type::addType(CargoItineraryLegsType::TYPE_NAME, CargoItineraryLegsType::class);
        }
        if (! Type::hasType(CargoTrackingIdType::TYPE_NAME)) {
            Type::addType(CargoTrackingIdType::TYPE_NAME, CargoTrackingIdType::class);
        }
    }
}