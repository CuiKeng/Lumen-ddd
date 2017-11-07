<?php

namespace App\Repository;

use App\Contract\Repository\CargoRepositoryInterface;
use App\Domain\Cargo\Cargo;
use Illuminate\Support\Facades\DB;
use App\Domain\Cargo\TrackingId;
use App\Domain\Cargo\RouteSpecification;

class CargoRepository implements CargoRepositoryInterface
{   
    /**
     * 保存货运数据
     * 
     * @param Cargo $cargo
     */
    public function insert(Cargo $cargo)
    {
        DB::table('cargo')->insert([
            'tracking_id' => $cargo->getTrackingId()->toString(),
            'origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_destination' => $cargo->getRouteSpecification()->getDestination()
        ]);
    }
    
    /**
     * 根据货运单号获取货运数据
     * 
     * @param TrackingId $trackingId
     */
    public function get(TrackingId $trackingId)
    {
        $cargoCollection = DB::table('cargo')->where('tracking_id', $trackingId->toString())->first();
        if (!$cargoCollection) {
            return null;
        }
        
        $routeSpecification = app()->make(RouteSpecification::class, [
            'origin' => $cargoCollection->route_origin,
            'destination' => $cargoCollection->route_destination
        ]);
        $cargo = app()->make(Cargo::class, [
            'trackingId' => TrackingId::fromString($cargoCollection->tracking_id),
            'routeSpecification' => $routeSpecification
        ]);
        
        return $cargo;
    }
}