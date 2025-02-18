<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate(['flight_number' => 'required|string']);
        $flight = Flight::where('flight_number', $validated['flight_number'])->first();

        if (!$flight || $flight->seats_available <= 0) {
            return response()->json([
                'message' => 'No seats available',
                '$validated' => $validated,
            ], 400);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $flight->id
        ]);

        $flight->decrement('seats_available');
        return response()->json(['data' => ['message' => 'Рейс забронирован']], 201);
    }
}
