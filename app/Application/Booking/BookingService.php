<?php

declare(strict_types = 1);

namespace App\Application\Booking;

use App\Contract\Repository\CargoRepositoryInterface;
use App\Domain\Cargo\Cargo;
use App\Domain\Cargo\RouteSpecification;
use Illuminate\Support\Facades\DB;
use App\Domain\Cargo\TrackingId;
use App\Application\Booking\Dto\CargoRoutingDto;
use App\Application\Booking\Exception\CargoNotFoundException;
use App\Application\Booking\Assembler\CargoRoutingDtoAssembler;

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
    
    public function listAllCargos(): array
    {
        $cargoRoutingDtoAssembler = app()->make(CargoRoutingDtoAssembler::class);
        
        return array_map(function (Cargo $cargo) use ($cargoRoutingDtoAssembler) {
            return $cargoRoutingDtoAssembler->toDto($cargo);
        }, $this->cargoRepository->getAll());
    }
}