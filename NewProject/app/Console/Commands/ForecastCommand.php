<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Forecast;
use App\Services\WeatherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:forecast {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $city = $this->argument('city');

        $existingCity = City::where(['name' => $city])->first();

        if (!$existingCity) {

            $city = City::create(['name' => $city]);
            $cityId = $city->id;

        } else {

            $cityId = $existingCity->id;
        }


        $existingForecast = Forecast::where('city_id', $cityId)
            ->whereDate('date', now()->toDateString())
            ->exists();

        if ($existingForecast) {
            $this->info('Forecast for today already exists!');
            return;
        }

        $weatherService = new WeatherService();

        $response = $weatherService->getForecast($city);


        if ($response->successful()) {
            $jsonResponse = $response->json();

            $forecastDay = $jsonResponse["forecast"]["forecastday"][0];


            $temperature = $forecastDay["day"]["avgtemp_c"];

            $forecastDate = $forecastDay["date"];

            $probability = $forecastDay["day"]["daily_chance_of_rain"];

            $weather_type = $forecastDay["day"]["condition"]["text"];


            Forecast::create([

                'city_id' => $cityId,

                'temperature' => $temperature,

                'date' => $forecastDate,

                'probability'  => $probability,

                'weather_type'  => $weather_type,

            ]);

            $this->info('Weather data successfully retrieved and stored.');

        } else {

            $errorMessage = $response->json()['error']['message'];
            $this->error("Failed to retrieve weather data: $errorMessage");

        }



    }
}
