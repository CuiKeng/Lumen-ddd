<?php

declare(strict_types = 1);

namespace App\Application\Booking\Assembler;

use App\Domain\Cargo\Itinerary;
use App\Application\Booking\Dto\ItineraryDto;
use App\Domain\Cargo\Leg;

class ItineraryDtoAssembler
{
    /**
     * @param Itinerary $itinerary
     * @return ItineraryDto
     */
    public function toDto(Itinerary $itinerary): ItineraryDto
    {
        $legDtos = [];
        
        foreach ($itinerary->getLegs() as $leg) {
            $legDtos[] = app()->make(LegDto::class, [
                'loadLocation' => $leg->getLoadLocation(),
                'unloadLocation' => $leg->getUnloadLocation(),
                'loadTime' => $leg->getLoadTime()->format(\DateTime::ISO8601),
                'unloadTime' => $leg->getUnloadTime()->format(\DateTime::ISO8601)
            ]);
        }
        
        return app()->make(ItineraryDto::class, [
            'legs' => $legDtos
        ]);
    }
    
    /**
     * @param ItineraryDto $itineraryDto
     * @return Itinerary
     */
    public function toItinerary(ItineraryDto $itineraryDto): Itinerary
    {
        $legs = [];
        
        foreach ($itineraryDto->getLegs() as $legDto) {
            $legs[] = app()->make(Leg::class, [
                'loadLocation' => $legDto->getLoadLocation(),
                'unloadLocation' => $legDto->getUnloadLocation(),
                'loadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legDto->getLoadTime()),
                'unloadTime' => \DateTime::createFromFormat(\DateTime::ISO8601, $legDto->getUnloadTime())
            ]);
        }
        
        return app()->make(Itinerary::class, compact('legs'));
    }
}