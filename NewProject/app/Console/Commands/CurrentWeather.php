<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CurrentWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:current-weather {city}';

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
        // $response = Http::get("http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$city}");


        // $response = Http::get("http://api.weatherapi.com/v1/current", [

        //     'key' => $apiKey,
        //     'q' => $city,
        //     'aqi' => 'no',
        //     // 'lang' => 'sr',

        // ]);



        $cityName = $this->argument('city');

        $existingCity = City::where(['name' => $cityName])->first();

        if (!$existingCity) {

            $city = City::create(['name' => $cityName]);
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



        $apiKey = env('WEATHER_API_KEY');

        $weatherUrl = env('WEATHER_API_URL');

        $response = Http::get("{$weatherUrl}/v1/forecast.json", [
            'key' => $apiKey,
            'q' => $cityName,
            'aqi' => 'no',
            'days' => 1,

        ]);


        if ($response->successful()) {
            $jsonResponse = $response->json();

            Forecast::create([
                'city_id' => $cityId,

                'temperature' => $jsonResponse["forecast"]["forecastday"][0]["day"]["avgtemp_c"],

                'date' => $jsonResponse["forecast"]["forecastday"][0]["date"],

                'probability'  => $jsonResponse["forecast"]["forecastday"][0]["day"]["daily_chance_of_rain"],

                'weather_type'  => $jsonResponse["forecast"]["forecastday"][0]["day"]["condition"]["text"],


            ]);

            $this->info('Weather data successfully retrieved and stored.');

        } else {

            $errorMessage = $response->json()['error']['message'];
            $this->error("Failed to retrieve weather data: $errorMessage");

        }



    }
}
