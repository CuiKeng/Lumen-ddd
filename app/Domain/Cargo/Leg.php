<?php

declare(strict_types = 1);

namespace App\Domain\Cargo;

use App\Domain\Aggregate;

class Leg implements Aggregate
{
    /**
     * @var string
     */
    private $loadLocation;
    
    /**
     * @var string
     */
    private $unloadLocation;
    
    /**
     * @var \DateTime
     */
    private $loadTime;
    
    /**
     * @var \DateTime
     */
    private $unloadTime;
    
    /**
     * Construct
     * 
     * @param string $loadLocation
     * @param string $unloadLocation
     * @param \DateTime $loadTime
     * @param \DateTime $unloadTime
     */
    public function __construct(string $loadLocation, string $unloadLocation, \DateTime $loadTime, \DateTime $unloadTime)
    {
        $this->loadLocation = $loadLocation;
        $this->unloadLocation = $unloadLocation;
        $this->loadTime = $loadTime;
        $this->unloadTime = $unloadTime;
    }
    
    /**
     * @return string
     */
    public function getLoadLocation(): string
    {
        return $this->loadLocation;
    }
    
    /**
     * @return string
     */
    public function getUnloadLocation(): string
    {
        return $this->unloadLocation;
    }
    
    /**
     * @return DateTime
     */
    public function getLoadTime(): \DateTime
    {
        return $this->loadTime;
    }
    
    /**
     * @return DateTime
     */
    public function getUnloadTime(): \DateTime
    {
        return $this->unloadTime;
    }
}