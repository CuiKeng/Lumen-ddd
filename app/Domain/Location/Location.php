<?php

namespace App\Domain\Location;

use App\Domain\Aggregate;

class Location implements Aggregate
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