<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        User::on()->truncate();
        $password = Hash::make('movie.api');
        $faker = \Faker\Factory::create();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => $password
        ]);

        for($i = 0; $i <= 10; $i++){
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => $password
            ]);
        }

    }
}
