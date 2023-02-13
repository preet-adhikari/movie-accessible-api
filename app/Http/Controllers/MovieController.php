<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

     /**
     * Handles the json data of Genres and Production Companies.
     *
     * @return array
     */
    public function handleJsonData($genre , $productionCompanies)
    {
        $genres = [];
        $production_companies = [];
        $genre = strip_tags($genre);
        $productionCompanies = strip_tags($productionCompanies);
        $genreArray = explode(',' , strtolower($genre));
        $genreArray = preg_replace('/[^a-zA-Z0-9_ -]/s' , '' , array_map('trim' , $genreArray));
        $productionCompaniesArray = explode(',' , strtolower($productionCompanies));
        $productionCompaniesArray = preg_replace('/[^a-zA-Z0-9_ -]/s' , '' , array_map('trim' , $productionCompaniesArray));

        $movies = Movie::all()->toArray();
        foreach($movies as $movie){
            // For genres
            foreach($movie['genres'] as $key => $genre){
                foreach($genreArray as $potentialGenreEntry){
                    if(strtolower($genre['name']) == strtolower($potentialGenreEntry))
                    {
                        if(!empty($genres)){
                            foreach($genres as $g){
                                if( strtolower($genre['name']) == strtolower($g['name']))
                                {
                                   break 2;
                                }
                            }
                        }
                        $genres[] = [
                            'id' => $genre['id'],
                            'name' => $genre['name']
                        ];
                    }
                }
            }
          
            // For Production Companies
            foreach($movie['production_companies'] as $productionCompany)
            {
                foreach($productionCompaniesArray as $potentialProductionCompany)
                {
                    if(strtolower($productionCompany['name']) == strtolower($potentialProductionCompany))
                    {
                        if(!empty($production_companies)){
                            foreach($production_companies as $p){
                                if( strtolower($productionCompany['name']) == strtolower($p['name']))
                                {
                                   break 2;
                                }
                            }
                        }
                        $production_companies[] = [
                            'name' => $productionCompany['name'],
                            'id' => $productionCompany['id']
                        ];
                    }
                }
            }
        }

        foreach($genreArray as $k => $genre)
        {
            foreach($genres as $g)
            {
                if(strtolower($g['name']) == strtolower($genre)){
                    unset($genreArray[$k]);
                }
            }    
        }
        
        foreach($productionCompaniesArray as $k => $productionCompany)
        {
            foreach($production_companies as $p)
            {
                if(strtolower($p['name']) == strtolower($productionCompany)){
                    unset($productionCompaniesArray[$k]);
                }
            }
        }

        foreach($genreArray as $genre)
        {
            if($genre)
            {
                $genres[] = [
                    'id' => random_int(1000, 100000),
                    'name' => ucfirst($genre)
                ];
            }   
        }

        foreach ($productionCompaniesArray as $productionCompany)
        {
            if($productionCompany){
                $production_companies[] = [
                    'id' => random_int(1000, 100000),
                    'name' => ucwords($productionCompany)
                ];
            }   
        }

        return [
            'genres' => $genres,
            'production_companies' => $production_companies
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the data
        $request->validate([
            'title' => 'required|unique:movies,title|string|max:200',
            'original_title' => 'required|unique:movies,original_title|string|max:200',
            'release_date' => 'required|date|after:today',
            'tagline' => 'string',
            'genres' => 'required|string',
        'production_companies' => 'required|string',
            'description' => 'required|string',
        'budget' => 'required|integer|min:0',
        'revenue' => 'required|integer|min:0',
        'homepage' => 'string'
        ]);

        
        // For JSON Data
        $jsonData = MovieController::handleJsonData($request->genres , $request->production_companies);
        
        $movie =  Movie::create([
            'title' => $request->title,
            'original_title' => $request->original_title,
            'release_date' => $request->release_date,
            'genres' => $jsonData['genres'],
            'production_companies' => $jsonData['production_companies'],
            'tagline' => $request->tagline,
            'description' => $request->description,
            'budget' => $request->budget,
            'revenue' => $request->revenue,
            'homepage' => $request->homepage
        ]);
        return response()->json($movie , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|unique:movies,title|string|max:200',
            'original_title' => 'required|unique:movies,original_title|string|max:200',
            'release_date' => 'required|date|after:today',
            'tagline' => 'string',
            'genres' => 'required|string',
        'production_companies' => 'required|string',
            'description' => 'required|string',
        'budget' => 'required|integer|min:0',
        'revenue' => 'required|integer|min:0',
        'homepage' => 'string'
        ]);

        // For JSON Data
        $jsonData = MovieController::handleJsonData($request->genres , $request->production_companies);
        $movie->update([
            'title' => $request->title,
            'original_title' => $request->original_title,
            'release_date' => $request->release_date,
            'genres' => $jsonData['genres'],
            'production_companies' => $jsonData['production_companies'],
            'tagline' => $request->tagline,
            'description' => $request->description,
            'budget' => $request->budget,
            'revenue' => $request->revenue,
            'homepage' => $request->homepage
        ]);

        return response()->json($movie , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null , 204);
    }

    public function search($params)
    {
        $movies = Movie::where('title' , 'Like' , '%'.$params . '%' )->get();
        return response()->json($movies);
    }

}
