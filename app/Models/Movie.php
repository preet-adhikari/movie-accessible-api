<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'genres' => 'array',
        'production_companies' => 'array'
    ];

    protected $fillable = ['title', 'original_title', 'release_date', 'tagline', 'genres', 'production_companies', 'description', 'budget', 'revenue', 'homepage'];
}
