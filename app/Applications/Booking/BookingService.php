<?php

declare(strict_types = 1);

namespace App\Applications\Booking;

use App\Contracts\Repositories\CargoRepositoryInterface;
use App\Domains\Cargo\Cargo;
use App\Domains\Cargo\RouteSpecification;
use Illuminate\Support\Facades\DB;
use App\Domains\Cargo\TrackingId;
use App\Applications\Booking\Dto\CargoRoutingDto;
use App\Applications\Booking\Exceptions\CargoNotFoundException;
use App\Applications\Booking\Assembler\CargoRoutingDtoAssembler;

class BookingService
{
    private $cargoRepository;
    
    public function __construct(CargoRepositoryInterface $cargoRepository)
    {
        $this->cargoRepository = $cargoRepository;
    }
    
    /**
     * 创建货运
     * 
     * @param string $origin
     * @param string $destination
     * @throws Exception
     */
    public function createNewCargo(string $origin, string $destination): string
    {
        $trackingId = TrackingId::generate();
        $routeSpecification = app()->make(RouteSpecification::class, [
            'origin' => $origin,
            'destination' => $destination
        ]);
        $cargo = app()->make(Cargo::class, [
            'trackingId' => $trackingId,
            'routeSpecification' => $routeSpecification
        ]);
        
        DB::beginTransaction();
        
        try {
            $this->cargoRepository->insert($cargo);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        return $trackingId->toString();
    }
    
    public function loadCargoForRouting(string $trackingId): CargoRoutingDto
    {
        $trackingId = TrackingId::fromString($trackingId);
        
        $cargo = $this->cargoRepository->get($trackingId);
        if (! $cargo) {
            throw CargoNotFoundException::forTrackingId($trackingId);
        }
        
        $cargoRoutingDtoAssembler = app()->make(CargoRoutingDtoAssembler::class);
        
        return $cargoRoutingDtoAssembler->toDto($cargo);
    }
}