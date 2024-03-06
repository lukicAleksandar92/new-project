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
        foreach ($cities as $city) {

            for ($i = 0; $i < $amount; $i++) {
                $weatherType = Forecast::WEATHERS[rand(0,2)];
                $probabilty = null;

                if($weatherType == 'rainy' || $weatherType == 'snow') {
                    $probabilty = rand(1,100);
                }

                $currentDate = Carbon::now();
                $forecastDate = $currentDate->addDays($i);

                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $faker->randomFloat(2, -30, 40),
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
