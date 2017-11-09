<?php

namespace App\Application\Booking\Dto;

class ItineraryDto
{
    /**
     * @var array
     */
    private $legs;
    
    /**
     * RouteCandidateDto construct
     * 
     * @param array $legs
     */
    public function __construct(array $legs)
    {
        $this->setLegs($legs);
    }
    
    /**
     * @return LegDto[]
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
        
        return ['legs' => $legsArrayCopy];
    }
    
    private function setLegs(array $legs): void
    {
        $this->legs = [];
        
        foreach ($legs as $leg) {
            $this->setLeg($leg);
        }
    }
    
    private function setLeg(LegDto $leg): void
    {
        $this->legs[] = $leg;
    }
}