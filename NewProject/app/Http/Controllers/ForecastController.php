<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{

    public function search(Request $request) {

        $cityName = $request->get('city');

        Artisan::call("app:forecast", ['city' => $cityName]);

        $cities = City::with('todaysForecast')
            ->where("name", "LIKE", "%$cityName%")->get();

        if (count($cities) == 0) {
            return redirect()->back()->with("error", "City NOT FOUND with given criteria '$cityName'");
        }

        $userFavourites = [];
        if (Auth::check()) {
            $userFavourites = Auth::user()->cityFavourites;
        }

        return view('searchResults', compact('cities'));
    }





    public function showCityForecast(City $city)
    {

        $weatherService = new WeatherService();

        $response = $weatherService->getSunsetAndSunrise($city);

        $jsonResponse = $response->json();

        $sunriseTime = $jsonResponse["astronomy"]["astro"]["sunrise"];
        $sunsetTime = $jsonResponse["astronomy"]["astro"]["sunset"];


        return view('cityForecast', compact('city', 'sunriseTime', 'sunsetTime'));
    }




    public function showAllForecast()
    {
        $allForecast = Forecast::orderBy('id', 'desc')->get();

        $userFavourites = [];

        if (Auth::check()) {
            $userFavourites = Auth::user()->cityFavourites;
        }

        return view('forecast', compact('allForecast', 'userFavourites'));
    }



}
