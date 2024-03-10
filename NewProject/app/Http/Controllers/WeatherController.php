<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Http\Request;


class WeatherController extends Controller
{
    public function showAllWeather()
    {
        $allWeathers = Weather::all();
        return view('weather', compact('allWeathers'));
    }


    public function showCityWeatherToday(City $city)
    {
        $citiesForecastToday = City::with('todaysForecast')->find($city->id);
        return view('cityWeather', compact('citiesForecastToday'));
    }



}
