<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

use function Termwind\ask;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $username = $this->command->getOutput()->ask('Koje ime?');

        if (empty($username)) {
            $this->command->getOutput()->error('Niste uneli ime');
            return;
        }

        if (User::where('name', $username)->exists()) {
            $this->command->getOutput()->error('Korisnik sa ovim imenom vec postoji!');
            return;
        };


        $email = $this->command->getOutput()->ask('Koji email?');

        if (empty($email)) {
            $this->command->getOutput()->error('Ne moze prazno polje za email!');
            return;
        }

        if (User::where('email', $email)->exists()) {
            $this->command->getOutput()->error('Korisnik sa ovim emailom vec postoji!');
            return;
        }


        $password = $this->command->getOutput()->ask('Koja sifra?');

        if (empty($password)) {
            $this->command->getOutput()->error('Niste uneli lozinku');
            return;
        }


        User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->command->getOutput()->info("uspesno unesen korisnik $username sa mailom $email ");
    }
}

        // $faker = Factory::create();
        // $amount = $this->command->getOutput()->ask('Koliko zelite korisnika da napravite?', 20);

        // $this->command->getOutput()->progressStart($amount);

        // for ($i = 0; $i < $amount; $i++)
        // {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => Hash::make('1111'),
        //     ]);

        //     $this->command->getOutput()->progressAdvance();
        // }

        // $this->command->getOutput()->progressFinish();



        // for ($i = 0; $i < 5; $i++)
        // {
        //     User::create([
        //         'name' => 'TestIme'.$i,
        //         'email' => 'testmail' . $i . '@mail.com',
        //         'password' => Hash::make('1111'),
        //     ]);
        // }
