<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Http\Request;

class ForecastController extends Controller
{

    public function search(Request $request) {

        $cityName = $request->get('city');

        // SELECT * FROM City WHERE name LIKE %Beograd%
        $cities = City::with('todaysForecast')
        ->where("name", "LIKE", "%$cityName%")->get();

        if(count($cities) == 0) {
            return redirect()->back()->with("error", "city NOT FOUND with given criteria '$cityName' ");
        }


        return view('searchResults', compact('cities'));

    }



    public function showCityForecast(City $city)
    {
        return view('cityForecast', compact('city'));
    }



    public function showAllForecast()
    {
        $allForecast = Forecast::orderBy('id', 'desc')->get();
        return view('forecast', compact('allForecast'));
    }


}
