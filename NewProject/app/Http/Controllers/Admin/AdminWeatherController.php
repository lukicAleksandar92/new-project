<?php

namespace App\Http\Controllers\Admin;

use App\Models\Weather;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AdminWeatherController extends Controller
{


    public function getAllWeather()
    {
        $allWeathers = Weather::all();
        return view("admin/allWeather", compact('allWeathers'));
    }



    public function updateWeather(Request $request, Weather $weather)
    {

        $request->validate([
            "temperature" => "required",
            "city_id" => "required|exists:cities,id",
        ]);

        $weather = Weather::where(['city_id' => $request->get("city_id")])->first();
        $weather->temperature = $request->get('temperature');
        $weather->save();

        return redirect()->back();

    }





    // public function createNewWeather(Request $request) {
    //     $request->validate([
    //         "city_id" => "required|integer",
    //         // "country" => "required|string",
    //         "temperature" => "required|integer",
    //         "date" => "required|date_format:Y-m-d",
    //     ]);

    //     $existingWeather = Weather::where('date', $request->get("date"))->exists();
    //     if ($existingWeather) {
    //         return redirect()->back()->withErrors(['date' => 'Weather for this date already exists.']);
    //     }

    //     Weather::create([
    //         "city_id" => $request->get("city_id"),
    //         // "country" => $request->get("country"),
    //         "temperature" => $request->get("temperature"),
    //         "date" => $request->get("date"),
    //     ]);

    //     return redirect()->route("admin.allWeather");
    // }




    // public function editWeather(Request $request, Weather $weather) {
    //     return view('admin.editWeather', compact('weather'));
    // }




    // public function deleteWeather($weather) {

    //     $singleWeather = Weather::where(['id' => $weather])->first();

    //     if($singleWeather === null) {
    //         die("Doesn't exist");
    //     }

    //     $singleWeather->delete();

    //     return redirect()->back();
    // }





}
