<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        $forecasts = [
            "beograd" => [22,23,24,25,26],
            "sarajevo" => [15,16,17,18,19],
        ];

        $city = strtolower($city);

        if(!array_key_exists($city, $forecasts))
        {
            die("ovaj grad ne postoji");
        }
    }





}
