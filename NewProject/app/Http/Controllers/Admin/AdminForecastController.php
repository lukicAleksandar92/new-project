<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forecast;
use Illuminate\Http\Request;

class AdminForecastController extends Controller
{

    public function addForecast(Request $request)
    {

        $request->validate([
            "city_id" => "required|exists:cities,id",
            "temperature" => "required|integer",
            "date" => "required|date_format:Y-m-d",
            "probability" => "",
            "weather_type" => "required",
        ]);

        $existingWeather = Forecast::where('date', $request->get("date"))->exists();
        if ($existingWeather) {
            return redirect()->back()->withErrors(['date' => 'Forecast for this date already exists.']);
        }


        Forecast::with('city')->create($request->all());

        // Forecast::create([
        //     "city_id" => $request->get("city_id"),
        //     "temperature" => $request->get("temperature"),
        //     "date" => $request->get("date"),
        //     "probability"  => $request->get("probability"),
        //     "weather_type"  => $request->get("weather_type"),
        // ]);

        return redirect()->back();

    }




        // public function showCityForecast(City $city)
        // {

        // $allForecasts = Forecast::where(['city_id' => $city->id])->get();

        // dd($allForecasts);

        // return view('forecast', compact('allForecasts'));

        // dd($city->name);

        // $forecasts = [
        //     "beograd" => [22,23,24,25,26],
        //     "sarajevo" => [15,16,17,18,19],
        // ];

        // $city = strtolower($city);

        // if(!array_key_exists($city, $forecasts))
        // {
        //     die("ovaj grad ne postoji");
        // }

        // }






}
