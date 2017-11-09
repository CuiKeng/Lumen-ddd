<?php

namespace App\Repository;

use App\Contract\Repository\CargoRepositoryInterface;
use App\Domain\Cargo\Cargo;
use Illuminate\Support\Facades\DB;
use App\Domain\Cargo\TrackingId;
use App\Domain\Cargo\RouteSpecification;
use App\Domain\Cargo\Leg;
use App\Domain\Cargo\Itinerary;

class CargoRepository implements CargoRepositoryInterface
{   
    public function store(Cargo $cargo)
    {
        DB::table('cargo')->updateOrInsert([
            'tracking_id' => $cargo->getTrackingId()->toString()
        ], [
            'origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_origin' => $cargo->getRouteSpecification()->getOrigin(),
            'route_destination' => $cargo->getRouteSpecification()->getDestination(),
            'itinerary_legs' => json_encode(array_map(function (Leg $leg) {
                return [
                    'load_location' => $leg->getLoadLocation(),
                    'unload_location' => $leg->getUnloadLocation(),
                    'load_time' => $leg->getLoadTime()->format(\DateTime::ISO8601),
                    'unload_time' => $leg->getUnloadTime()->format(\DateTime::ISO8601)
                ];
            }, $cargo->getItinerary()->getLegs()))
        ]);
    }
    
    /**
     * 根据货运单号获取货运数据
     * 
     * @param TrackingId $trackingId
     * @return Cargo
     */
    public function get(TrackingId $trackingId)
    {
        $item = DB::table('cargo')->where('tracking_id', $trackingId->toString())->first();
        if (!$item) {
            return null;
        }
        
        $legDatas = json_decode($item->itinerary_legs, true);
        if (!$legDatas) {
            $itinerary = null;
        } else {
            $itinerary = app()->make(Itinerary::class, [
                'legs' => array_map(function ($legData) {
                    return app()->make(Leg::class, [
                        'loadLocation' => $legData['load_location'],
                        'unloadLocation' => $legData['unload_location'],
                        'loadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['load_time']),
                        'unloadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['unload_time'])
                    ]);
                }, $legDatas)
            ]);
        }
        
        $routeSpecification = app()->make(RouteSpecification::class, [
            'origin' => $item->route_origin,
            'destination' => $item->route_destination
        ]);
        
        $cargo = app()->make(Cargo::class, [
            'trackingId' => TrackingId::fromString($item->tracking_id),
            'routeSpecification' => $routeSpecification,
            'itinerary' => $itinerary
        ]);

        return $cargo;
    }
    
    /**
     * 获取所有货运数据
     * 
     * @return Cargo[]
     */
    public function getAll()
    {
        $items = DB::table('cargo')->get()->all();
        
        return array_map(function ($item) {
            $legDatas = json_decode($item->itinerary_legs, true);
            if (! $legDatas) {
                $itinerary = null;
            } else {
                $itinerary = app()->make(Itinerary::class, [
                    'legs' => array_map(function ($legData) {
                        return app()->make(Leg::class, [
                            'loadLocation' => $legData['load_location'],
                            'unloadLocation' => $legData['unload_location'],
                            'loadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['load_time']),
                            'unloadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legData['unload_time'])
                        ]);
                    }, $legDatas)
                ]);
            }
            
            $routeSpecification = app()->make(RouteSpecification::class, [
                'origin' => $item->route_origin,
                'destination' => $item->route_destination
            ]);
            $cargo = app()->make(Cargo::class, [
                'trackingId' => TrackingId::fromString($item->tracking_id),
                'routeSpecification' => $routeSpecification,
                'itinerary' => $itinerary
            ]);
            
            return $cargo;
        }, $items);
    }
}