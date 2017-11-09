<?php

namespace App\Domain\Location;

use App\Domain\ValueObject;

class UnLocode implements ValueObject
{
    /**
     * @var string 港口代码
     */
    private $unlocode;
    
    /**
     * UnLocode construct
     * 
     * @param string $unlocode
     */
    public function __construct(string $unlocode)
    {
        $this->unlocode = $unlocode;
    }
}