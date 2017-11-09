<?php

namespace App\Application\Booking\Dto;

class CargoRoutingDto
{
    /**
     * @var string
     */
    private $trackingId;
    /**
     * @var string
     */
    private $origin;
    /**
     * @var string
     */
    private $finalDestination;
    /**
     * @var array
     */
    private $legs = [];
    
    /**
     * Construct
     * 
     * @param string $trackingId
     * @param string $origin
     * @param string $finalDestination
     * @param array $legs
     */
    public function __construct(string $trackingId, string $origin, string $finalDestination, array $legs)
    {
        $this->trackingId = $trackingId;
        $this->origin = $origin;
        $this->finalDestination = $finalDestination;
        $this->legs = $legs;
    }
    
    /**
     * @return string
     */
    public function getTrackingId(): string
    {
        return $this->trackingId;
    }
    
    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }
    
    /**
     * @return string
     */
    public function getFinalDestination(): string
    {
        return $this->finalDestination;
    }
    
    /**
     * @return array
     */
    public function getLegs(): array
    {
        return $this->legs;
    }
    
    /**
     * @return array
     */
    public function getArrayCopy(): array
    {
        $legsArrayCopy = [];
        
        foreach ($this->getLegs() as $leg) {
            $legsArrayCopy[] = [
                'load_location' => $leg->getLoadLocation(),
                'unload_location' => $leg->getUnloadLocation(),
                'load_time' => $leg->getLoadTime(),
                'unload_time' => $leg->getUnloadTime()
            ];
        }
        
        return [
            'tracking_id' => $this->getTrackingId(),
            'origin' => $this->getOrigin(),
            'final_destination' => $this->getFinalDestination(),
            'legs' => $legsArrayCopy
        ];
    }
}