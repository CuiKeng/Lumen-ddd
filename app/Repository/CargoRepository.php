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
        $item = DB::table('cargo')->where('tracking_id', $trackingId->toString())->first();
        if (!$item) {
            return null;
        }
        
        $routeSpecification = app()->make(RouteSpecification::class, [
            'origin' => $item->route_origin,
            'destination' => $item->route_destination
        ]);
        $cargo = app()->make(Cargo::class, [
            'trackingId' => TrackingId::fromString($item->tracking_id),
            'routeSpecification' => $routeSpecification
        ]);
        
        return $cargo;
    }
    
    /**
     * 获取所有货运数据
     */
    public function getAll()
    {
        $items = DB::table('cargo')->get()->all();
        
        return array_map(function ($item) {
            $routeSpecification = app()->make(RouteSpecification::class, [
                'origin' => $item->route_origin,
                'destination' => $item->route_destination
            ]);
            $cargo = app()->make(Cargo::class, [
                'trackingId' => TrackingId::fromString($item->tracking_id),
                'routeSpecification' => $routeSpecification
            ]);
            
            return $cargo;
        }, $items);
    }
}