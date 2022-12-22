<?php

namespace Database\Seeders;

use App\Imports\MoviesImport;
use App\Jobs\ImportMovies;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Truncate before seeding
        Movie::on()->truncate();

        $this->call(UsersTableSeeder::class);
        ImportMovies::dispatch();

    }
}
