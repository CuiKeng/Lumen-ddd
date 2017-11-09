<?php

namespace App\Domain\Cargo;

use App\Domain\Aggregate;

class Itinerary implements Aggregate
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