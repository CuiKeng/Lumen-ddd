<?php

namespace App\Domain\Location;

use App\Contract\Domain\ValueObject;

class VoyageNumber implements ValueObject
{
    /**
     * @var string
     */
    private $number;
    
    /**
     * VoyageNumber construct
     * 
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }
    
    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}