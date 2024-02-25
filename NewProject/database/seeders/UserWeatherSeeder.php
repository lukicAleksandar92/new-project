<?php

namespace Database\Seeders;

use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = $this->command->getOutput()->ask('Unesite ime grada');
        if($city==null) {
            $this->command->getOutput()->error('Niste uneli ime grada');
            return;
        }

        if (Weather::where('city', $city)->exists()) {
            $this->command->getOutput()->error('Grad sa ovim nazivom vec postoji!');
            return;
        };


        $temperature = $this->command->getOutput()->ask('Unesite  temperaturu');
        if($temperature==null) {
            $this->command->getOutput()->error('Niste uneli temperaturu');
            return;
        }


        $country = $this->command->getOutput()->ask('Iz koje drzave je taj grad?');
        if($country==null) {
            $this->command->getOutput()->error('Niste uneli naziv drzave');
            return;
        }


        Weather::create([
            'city' => $city,
            'temperature' => $temperature,
            'country' => $country,
            'date' => Carbon::today()->format('Y-m-d'),
        ]);

        $this->command->getOutput()->info("uspesno unesen grad $city sa temperaturom od $temperature stepeni");

    }
}
