<?php

namespace App\Http\Controller;

use App\Application\Booking\BookingService;
use Illuminate\Http\Request;
use App\Application\Booking\Exception\CargoNotFoundException;
use App\Http\Exception\NotFoundHttpException;
use App\Application\Booking\Dto\CargoRoutingDto;
use App\Application\Booking\Dto\LegDto;
use App\Application\Booking\Dto\ItineraryDto;

class CargoController extends Controller
{
    /**
     * @var BookingService
     */
    private $bookingService;
    
    /**
     * CargoController construct
     * 
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    
    public function create(Request $request)
    {
        $data = $request->all();
        
        // TODO Validate
        
        $trackingId = $this->bookingService->createNewCargo($data['origin'], $data['destination']);
        
        return response()->json([
            'trackingId' => $trackingId
        ]);
    }
    
    public function update(string $trackingId, Request $request)
    {
        $data = $request->all();
        // TODO Validate
        
        $itineraryDto = app()->make(ItineraryDto::class, [
            'legs' => array_map(function (array $legData) {
                return app()->make(LegDto::class, [
                    'loadLocation' => $legData['load_location'],
                    'unloadLocation' => $legData['unload_location'],
                    'loadTime' => $legData['load_time'],
                    'unloadTime' => $legData['unload_time']
                ]);
            }, $data['legs'])
        ]);
        
        try {
            $this->bookingService->assignCargoToRoute($trackingId, $itineraryDto);
            
            $cargoRoutingDto = $this->bookingService->loadCargoForRouting($trackingId);
            
            return response()->json($cargoRoutingDto->getArrayCopy());
        } catch (CargoNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
    
    public function getCargo(string $trackingId)
    {
        try {
            $cargoRoutingDto = $this->bookingService->loadCargoForRouting($trackingId);
            
            return response()->json($cargoRoutingDto->getArrayCopy());
        } catch (CargoNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
    
    public function getCargos()
    {
        return response()->json(array_map(function (CargoRoutingDto $cargoRoutingDto) {
            return $cargoRoutingDto->getArrayCopy();
        }, $this->bookingService->listAllCargos()));
    }
}