<?php

namespace App\Application\Booking\Dto;

class LegDto
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
     * @var string
     */
    private $loadTime;
    
    /**
     * @var string
     */
    private $unloadTime;
    
    /**
     * Construct
     * 
     * @param string $loadLocation
     * @param string $unloadLocation
     * @param string $loadTime
     * @param string $unloadTime
     */
    public function __construct(string $loadLocation, string $unloadLocation, string $loadTime, string $unloadTime)
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
     * @return string
     */
    public function getLoadTime(): string
    {
        return $this->loadTime;
    }
    
    /**
     * @return string
     */
    public function getUnloadTime(): string
    {
        return $this->unloadTime;
    }
    
    /**
     * @return array
     */
    public function getArrayCopy(): array
    {
        return [
            'load_location' => $this->getLoadLocation(),
            'unload_location' => $this->getUnloadLocation(),
            'load_time' => $this->getLoadTime(),
            'unload_time' => $this->getUnloadTime()
        ];
    }
}