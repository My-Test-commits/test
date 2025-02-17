<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index() {
        return response()->json(['data' => Flight::all()]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'flight_number' => 'required|string|unique:flights',
            'destination' => 'required|string',
            'launch_date' => 'required|date',
            'seats_available' => 'required|integer|min:1'
        ]);

        Flight::create($validated);
        return response()->json(['data' => ['message' => 'Космический полет создан']], 201);
    }
}
