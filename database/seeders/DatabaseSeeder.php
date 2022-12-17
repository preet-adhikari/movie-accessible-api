<?php

namespace Database\Seeders;

use App\Imports\MoviesImport;
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

        //Import the data
        Excel::import(new MoviesImport , storage_path('app/public/files/tmdb_5000_movies.csv'));
    }
}
