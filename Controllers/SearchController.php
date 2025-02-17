<?php

namespace App\Http\Controllers;

use App\Models\Mission;
//use App\Models\Pilor;

// Предполагается, что у вас есть модель для пилотов
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Получаем ключевое слово из параметров запроса
        $query = $request->query('query');

        // Ищем по миссиям
        $missions = Mission::where('mission->name', 'like', "%{$query}%")
            ->orWhereJsonContains('launch_details->name', $query)
            ->orWhereJsonContains('landing_details->name', $query)
            ->get();

        // Возвращаем результат в формате JSON
        return response()->json([
//            '1'=>$query
            'missions' => $missions,
//            'pilots' => $pilots,
        ]);
    }
}
