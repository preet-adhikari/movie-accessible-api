<?php

namespace App\Imports;

use App\Models\Movie;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MoviesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Movie([
            'title' => $row['title'],
            'original_title' => $row['original_title'],
            'release_date' => $row['release_date'],
            'tagline' => $row['tagline'],
            'genres' => $row['genres'],
            'description' => $row['overview'],
            'production_companies' => $row['production_companies'],
            'budget' => $row['budget'],
            'revenue' => $row['revenue'],
            'homepage' => $row['homepage']
        ]);
    }
}
