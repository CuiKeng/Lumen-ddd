<?php

namespace App\Domain\Location;

use App\Contract\Domain\Entity;

class UnLocode implements Entity
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