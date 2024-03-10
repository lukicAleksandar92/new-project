<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForecastController extends Controller
{

    public function search(Request $request) {

        $cityName = $request->get('city');

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
        return view('cityForecast', compact('city'));
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
