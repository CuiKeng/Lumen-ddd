<?php

namespace App\Http\Controller;

use App\Application\Booking\BookingService;
use Illuminate\Http\Request;
use App\Application\Booking\Exception\CargoNotFoundException;
use App\Http\Exception\NotFoundHttpException;

class CargoController extends Controller
{
    public function create(Request $request, BookingService $bookingService)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        
        $trackingId = $bookingService->createNewCargo($origin, $destination);
        
        return response()->json([
            'trackingId' => $trackingId
        ]);
    }
    
    public function getCargo(string $trackingId, BookingService $bookService)
    {
        try {
            $cargoRoutingDto = $bookService->loadCargoForRouting($trackingId);
            
            return response()->json($cargoRoutingDto->getArrayCopy());
        } catch (CargoNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}