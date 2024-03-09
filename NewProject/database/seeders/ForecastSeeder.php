<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $amount = $this->command->getOutput()->ask('Koliko zelite prognoza temperature za svaki grad da napravite?', 5);

        $this->command->getOutput()->progressStart($amount);

        $cities = City::all();

        $previousTemperature = rand(-30,40);


        foreach ($cities as $city) {

            for ($i = 0; $i < $amount; $i++) {

                $weatherType = Forecast::WEATHERS[rand(0,3)];
                $probabilty = null;

                if($weatherType == 'rainy' || $weatherType == 'snow' || $weatherType == 'cloudy') {
                    $probabilty = rand(1,100);
                }


                $temperature = $previousTemperature + rand(-5, 5);

                $temperature = min(40, max(-30, $temperature));

                $previousTemperature = $temperature;


                if ($temperature >= -30 && $temperature <= -11) {
                    $weatherType = ($faker->boolean) ? 'snow' : 'sunny';
                } elseif ($temperature >= -10 && $temperature <= 1) {
                    $weatherTypes = ['rainy', 'cloudy', 'snow', 'sunny'];
                    $weatherType = $weatherTypes[array_rand($weatherTypes)];
                } elseif ($temperature >= 2 && $temperature <= 14) {
                    $weatherTypes = ['sunny', 'cloudy', 'rainy'];
                    $weatherType = $weatherTypes[array_rand($weatherTypes)];
                } elseif ($temperature >= 15 && $temperature <= 40) {
                    $weatherType = ($faker->boolean) ? 'sunny' : 'rainy';
                }


                $currentDate = Carbon::now();
                $forecastDate = $currentDate->addDays($i);

                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $temperature,
                    'date' => $forecastDate->format('Y-m-d'),
                    'weather_type' => $weatherType,
                    'probability' => $probabilty,
                ]);



                $this->command->getOutput()->progressAdvance();
            }
        }

        $this->command->getOutput()->progressFinish();
    }
}
