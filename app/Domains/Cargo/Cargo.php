<?php

namespace App\Domains\Cargo;

/**
 * 货运
 * 
 * @author cuikeng
 */
class Cargo
{
    /**
     * @var TrackingId
     */
    private $trackingId;
    
    /**
     * @var RouteSpecification
     */
    private $routeSpecification;
    
    /**
     * @var Itinerary
     */
    private $itinerary;
    
    /**
     * Construct
     * 
     * @param TrackingId $trackingId
     * @param RouteSpecification $routeSpecification
     */
    public function __construct(TrackingId $trackingId, RouteSpecification $routeSpecification, Itinerary $itinerary = null)
    {
        $this->trackingId = $trackingId;
        $this->routeSpecification = $routeSpecification;
        $this->itinerary = is_null($itinerary) ? app()->make(Itinerary::class, ['legs' => []]) : $itinerary;
    }
    
    /**
     * @return \App\Domains\Cargo\TrackingId
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }
    
    /**
     * @return \App\Domains\Cargo\RouteSpecification
     */
    public function getRouteSpecification()
    {
        return $this->routeSpecification;
    }
    
    /**
     * @return \App\Domains\Cargo\Itinerary
     */
    public function getItinerary()
    {
        return $this->itinerary;
    }
}