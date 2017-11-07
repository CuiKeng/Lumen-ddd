<?php

namespace App\Http\Controller;

use App\Application\Booking\BookingService;
use Illuminate\Http\Request;
use App\Application\Booking\Exception\CargoNotFoundException;
use App\Http\Exception\NotFoundHttpException;
use App\Application\Booking\Dto\CargoRoutingDto;

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
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        
        $trackingId = $this->bookingService->createNewCargo($origin, $destination);
        
        return response()->json([
            'trackingId' => $trackingId
        ]);
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