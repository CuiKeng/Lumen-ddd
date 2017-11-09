<?php

namespace App\Domain\Cargo;

use App\Contract\Domain\Entity;

class Cargo implements Entity
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
        $this->setItinerary($itinerary);
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
    
    /**
     * @param Itinerary $itinerary
     */
    public function assignToRoute(Itinerary $itinerary)
    {
        $this->itinerary = $itinerary;
    }
    
    private function setItinerary($itinerary)
    {
        if (! $itinerary instanceof Itinerary) {
            $this->itinerary = app()->make(Itinerary::class, ['legs' => []]);
        } else {
            $this->itinerary = $itinerary;
        }
    }
}