<?php

namespace App\Http\Controllers;

use App\Applications\Booking\BookingService;
use Illuminate\Http\Request;

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
        
    }
}