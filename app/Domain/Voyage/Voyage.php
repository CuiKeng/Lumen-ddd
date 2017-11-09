<?php

namespace App\Domain\Location;

use App\Domain\Aggregate;

class Voyage implements Aggregate
{
    /**
     * @var VoyageNumber
     */
    private $voyageNumber;
    
    /**
     * @var Schedule
     */
    private $schedule;
    
    /**
     * Voyage construct
     * 
     * @param VoyageNumber $voyageNumber
     * @param Schedule $schedule
     */
    public function __construct(VoyageNumber $voyageNumber, Schedule $schedule)
    {
        $this->voyageNumber = $voyageNumber;
        $this->schedule = $schedule;
    }
    
    /**
     * @return \App\Domain\Location\VoyageNumber
     */
    public function getVoyageNumber(): VoyageNumber
    {
        return $this->voyageNumber;
    }
    
    /**
     * @return \App\Domain\Location\Schedule
     */
    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }
}