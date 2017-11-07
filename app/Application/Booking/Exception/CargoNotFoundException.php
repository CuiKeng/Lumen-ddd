<?php

declare(strict_types = 1);

namespace App\Application\Booking\Exception;

use App\Domain\Cargo\TrackingId;

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