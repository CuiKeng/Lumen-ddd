<?php

namespace App\Domain\Location;

use App\Contract\Domain\Entity;

class Location implements Entity
{
    /**
     * @var UnLocode
     */
    private $unLocode;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * Location construct
     * 
     * @param UnLocode $unLocode
     * @param string $name
     */
    public function __construct(UnLocode $unLocode, string $name)
    {
        $this->unLocode = $unLocode;
        $this->name = $name;
    }
}