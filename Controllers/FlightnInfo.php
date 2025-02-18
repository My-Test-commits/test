<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightnInfo extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            "data" => [
                "name" => "Аполлон-11",
                "crew_capacity" => 3,
                "cosmonaut" => [
                    [
                        "name" => "Нил Армстронг",
                        "role" => "Командир"
                    ],
                    [
                        "name" => "Базз Олдрин",
                        "role" => "Пилот лунного модуля"
                    ],
                    [
                        "name" => "Майкл Коллинз",
                        "role" => "Пилот командного модуля"
                    ]
                ],
                "launch_details" => [
                    "launch_date" => "1969-07-16",
                    "launch_site" => [
                        "name" => "Космический центр имени Кеннеди",
                        "latitude" => "28.5721000",
                        "longitude" => "-80.6480000"
                    ]
                ],
                "landing_details" => [
                    "landing_date" => "1969-07-20",
                    "landing_site" => [
                        "name" => "Море спокойствия",
                        "latitude" => "0.6740000",
                        "longitude" => "23.4720000"
                    ]
                ]
            ]
        ]);
    }
}
