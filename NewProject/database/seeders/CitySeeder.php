<?php

namespace Database\Seeders;

use App\Models\City;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();
        $amount = $this->command->getOutput()->ask('Koliko zelite gradova da napravite?', 100);

        $this->command->getOutput()->progressStart($amount);

        for ($i = 0; $i < $amount; $i++)
        {
            City::create([
                'name' => $faker->city,
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();


    }
}
