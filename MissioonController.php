<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index() {
        return response()->json(['data' => Mission::all()]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'mission' => 'required|string',
            'launch_details' => 'required|json',
            'landing_details' => 'required|json',
            'spacecraft' => 'required|json'
        ]);

        $mission = Mission::create($validated);
        return response()->json(['data' => ['message' => 'Миссия добавлена']], 201);
    }

    public function update(Request $request, Mission $mission) {
        $mission->update($request->all());
        return response()->json(['data' => ['message' => 'Миссия обновлена']], 200);
    }

    public function destroy(Mission $mission) {
        $mission->delete();
        return response()->json([], 204);
    }
}
