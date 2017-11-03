<?php

declare(strict_types = 1);

namespace App\Applications\Booking;

use App\Contracts\Repositories\CargoRepositoryInterface;
use App\Domains\Cargo\Cargo;
use App\Domains\Cargo\RouteSpecification;
use Illuminate\Support\Facades\DB;
use App\Domains\Cargo\TrackingId;

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
        $routeSpecification = new RouteSpecification($origin, $destination);
        $cargo = new Cargo($trackingId, $routeSpecification);
        
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
}