<?php

namespace App\Repositories;

use App\Contracts\Repositories\CargoRepositoryInterface;
use App\Domains\Cargo\Cargo;
use Illuminate\Support\Facades\DB;

class CargoRepository implements CargoRepositoryInterface
{    
    public function insert(Cargo $cargo)
    {
        DB::table('cargo')->insert([
            'tracking_id' => $cargo->getTrackingId()->toString(),
            'origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_destination' => $cargo->getRouteSpecification()->getDestination()
        ]);
    }
    
    public function get()
    {
        
    }
}