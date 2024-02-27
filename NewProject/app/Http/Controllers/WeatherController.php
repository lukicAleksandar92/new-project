<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function showAllWeather()
    {
        $allWeathers = Weather::orderBy('id', 'desc')->get();
        return view('weather', compact('allWeathers'));
    }

    public function getAllWeather()
    {
        $allWeathers = Weather::orderBy('id', 'desc')->get();
        return view("admin/allWeather", compact('allWeathers'));
    }



    public function createNewWeather(Request $request) {
        $request->validate([
            "city" => "required|string",
            "country" => "required|string",
            "temperature" => "required|integer",
            "date" => "required|date_format:Y-m-d",
        ]);

        $existingWeather = Weather::where('city', $request->get("city"))->exists();
        if ($existingWeather) {
            return redirect()->back()->withErrors(['city' => 'City already exists.']);
        }

        Weather::create([
            "city" => $request->get("city"),
            "country" => $request->get("country"),
            "temperature" => $request->get("temperature"),
            "date" => $request->get("date"),
        ]);

        return redirect()->route("admin.allWeather");
    }




    public function editWeather(Request $request, Weather $weather) {
        return view('admin.editWeather', compact('weather'));
    }

        public function updateWeather(Request $request, Weather $weather) {

        $weather->city = $request->get('city');
        $weather->country = $request->get('country');
        $weather->temperature = $request->get('temperature');
        $weather->date = $request->get('date');
        $weather->save();

        return redirect()->route("admin.allWeather");
    }




    public function deleteWeather($weather) {

        $singleWeather = Weather::where(['id' => $weather])->first();

        if($singleWeather === null) {
            die("Ne postoji");
        }

        $singleWeather->delete();

        return redirect()->back();
    }







}
