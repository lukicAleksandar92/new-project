<?php

namespace Database\Seeders;

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
        $prognoza = [
            [
                'city' => 'New York',
                'temperature' => 22,
                'country' => 'USA',
                'date' => Carbon::today()->format('Y-m-d')
            ],
            [
                'city' => 'Chicago',
                'temperature' => 23,
                'country' => 'USA',
                'date' => Carbon::today()->format('Y-m-d')
            ],
            [
                'city' => 'Los Angeles',
                'temperature' => 24,
                'country' => 'USA',
                'date' => Carbon::today()->format('Y-m-d')
            ],
            [
                'city' => 'Miami',
                'temperature' => 26,
                'country' => 'USA',
                'date' => Carbon::today()->format('Y-m-d')
            ]
        ];

        foreach ($prognoza as $cityData) {
            Weather::create($cityData);
        }
    }
}
