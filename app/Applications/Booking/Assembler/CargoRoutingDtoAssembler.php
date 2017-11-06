<?php

declare(strict_types = 1);

namespace App\Applications\Booking\Assembler;

use App\Domains\Cargo\Cargo;
use App\Applications\Booking\Dto\CargoRoutingDto;
use App\Applications\Booking\Dto\LegDto;

class CargoRoutingDtoAssembler
{
    /**
     * @param Cargo $cargo
     * @return CargoRoutingDto
     */
    public function toDto(Cargo $cargo): CargoRoutingDto
    {
        $legs = [];
        
        foreach ($cargo->getItinerary()->getLegs() as $leg)
        {
            $legs[] = app()->make(LegDto::class, [
                'loadLocation' => $leg->getLoadLocation(),
                'unloadLocation' => $leg->getUnloadLocation(),
                'loadTime' => $leg->getLoadTime()->format(\DateTime::ISO8601),
                'unloadTime' => $leg->getUnloadTime()->format(\DateTime::ISO8601)
            ]);
        }
        
        return app()->make(CargoRoutingDto::class, [
            'trackingId' => $cargo->getTrackingId()->toString(),
            'origin' => $cargo->getRouteSpecification()->getOrigin(),
            'finalDestination' => $cargo->getRouteSpecification()->getDestination(),
            'legs' => $legs
        ]);
    }
}