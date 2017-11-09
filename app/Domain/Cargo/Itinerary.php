<?php

namespace App\Domain\Cargo;

use App\Contract\Domain\Entity;

class Itinerary implements Entity
{
    /**
     * @var Leg[]
     */
    private $legs = [];
    
    /**
     * Construct
     * 
     * @param array $legs
     */
    public function __construct(array $legs)
    {
        $this->legs = $legs;
    }
    
    /**
     * @return Leg[]
     */
    public function getLegs()
    {
        return $this->legs;
    }
}