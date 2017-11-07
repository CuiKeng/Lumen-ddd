<?php

namespace App\Http\Controllers;

use App\Applications\Booking\BookingService;
use Illuminate\Http\Request;
use App\Applications\Booking\Exceptions\CargoNotFoundException;
use App\Http\Exceptions\NotFoundHttpException;

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