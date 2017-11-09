<?php

namespace App\Domain\Location;

use App\Domain\Aggregate;

class CarrierMovement implements Aggregate
{
    /**
     * @var Location
     */
    private $departureLocation;
    
    /**
     * @var Location
     */
    private $arrivalLocation;
    
    /**
     * @var \DateTime
     */
    private $departureTime;
    
    /**
     * @var \DateTime
     */
    private $arrivalTime;
    
    /**
     * CarrierMovement construct
     * 
     * @param Location $departureLocation
     * @param Location $arrivalLocation
     * @param \DateTime $departureTime
     * @param \DateTime $arrivalTime
     */
    public function __construct(Location $departureLocation, Location $arrivalLocation, \DateTime $departureTime, \DateTime $arrivalTime)
    {
        $this->departureLocation = $departureLocation;
        $this->arrivalLocation = $arrivalLocation;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
    }
    
    /**
     * @return \App\Domain\Location\Location
     */
    public function getDepartureLocation(): Location
    {
        return $this->departureLocation;
    }
    
    /**
     * @return \App\Domain\Location\Location
     */
    public function getArrivalLocation(): Location
    {
        return $this->arrivalLocation;
    }
    
    /**
     * @return DateTime
     */
    public function getDepartureTime(): \DateTime
    {
        return $this->departureTime;
    }
    
    /**
     * @return DateTime
     */
    public function getArrivalTime(): \DateTime
    {
        return $this->arrivalTime;
    }
}