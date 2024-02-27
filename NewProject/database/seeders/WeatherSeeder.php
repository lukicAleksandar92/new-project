<?php

namespace Database\Seeders;

use App\Models\City;
use Faker\Factory;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        $cities = City::all();

        foreach ($cities as $city) {

            $userWeather = Weather::where(['city_id' => $city->id])->first();
            if($userWeather !== null) {

                $this->command->getOutput()->error("Grad vec postoji!");

            };

                Weather::create([
                    'city_id' => $city->id,

                    'temperature' => $faker->randomFloat(2, -30, 40),

                    'date' => Carbon::now(),
                ]);

        }


        // $prognoza = [
        //     [
        //         'city' => 'New York',
        //         'temperature' => 22,
        //         'country' => 'USA',
        //         'date' => Carbon::today()->format('Y-m-d')
        //     ],
        //     [
        //         'city' => 'Chicago',
        //         'temperature' => 23,
        //         'country' => 'USA',
        //         'date' => Carbon::today()->format('Y-m-d')
        //     ],
        //     [
        //         'city' => 'Los Angeles',
        //         'temperature' => 24,
        //         'country' => 'USA',
        //         'date' => Carbon::today()->format('Y-m-d')
        //     ],
        //     [
        //         'city' => 'Miami',
        //         'temperature' => 26,
        //         'country' => 'USA',
        //         'date' => Carbon::today()->format('Y-m-d')
        //     ],
        //     [
        //         'city' => 'Zajecar',
        //         'temperature' => 12,
        //         'country' => 'Serbia',
        //         'date' => Carbon::today()->format('Y-m-d')
        //     ]

        // ];

        // foreach ($prognoza as $cityData) {
        //     $cityExists = Weather::where('city', $cityData['city'])->first();

        //     if ($cityExists !== null) {
        //         $this->command->getOutput()->error('Grad vec postoji');
        //         continue;
        //     }

        //     Weather::create($cityData);

        // }
    }
}
