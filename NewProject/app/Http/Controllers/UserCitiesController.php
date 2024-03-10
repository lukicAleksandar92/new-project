<?php

namespace App\Http\Controllers;

use App\Models\UserCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCitiesController extends Controller
{

    public function favourite(Request $request, $city)  {

        $user = Auth::user();

        if($user === null ) {
             return
             redirect()
             ->back()
             ->with(["error" => "Login in order to like"]);
        }

        \App\Models\UserCities::create([
            'city_id' => $city,
            'user_id' => $user->id,
        ]);

        return redirect()->back();

    }


    public function removeFavourite($city) {

        $user = Auth::user();

        $favoriteCity = $user->cityFavourites->where('city_id', $city)->first();

        if ($favoriteCity) {
            $favoriteCity->delete();
        }

        return redirect()->back();
    }







}
