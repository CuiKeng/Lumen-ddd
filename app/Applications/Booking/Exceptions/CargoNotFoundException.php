<?php

declare(strict_types = 1);

namespace App\Applications\Booking\Exceptions;

use App\Domains\Cargo\TrackingId;

class CargoNotFoundException extends \RuntimeException
{
    public static function forTrackingId(TrackingId $trackingId): self
    {
        return new self(sprintf(
            'Cargo with TrackingId %s can not be found.',
            $trackingId->toString()
        ));
    }
}