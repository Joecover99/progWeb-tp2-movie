<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Movie::query();

        if($request->has('min_length')) {
            $query = $query->where('length', '>=', $request->input('min_length'));
        }

        if($request->has('max_length')) {
            $query = $query->where('length', '<=', $request->input('max_length'));
        }

        if($request->has('key_word')) {
            $keyWord = $request->input('key_word');
            $query = $query->where(function($query) use ($keyWord) {
                $query->where('title', 'like', '%'.$keyWord.'%')
                ->orWhere('description', 'like', '%'.$keyWord.'%');
            });
        }

        if($request->has('rating')) {
            $query = $query->where('rating', '=', $request->input('rating'));
        }

        // dd($query->toSql(), $query->getBindings());
        return MovieResource::collection($query->paginate(20));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Only if admin
    {
        // if ((isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) || $row["role"] == 1){
        //     $movie = Movie::create($request->all());
        //     }
        //$donnees = $request->all();
        
        // $unFilm = Film::create([ 
        //   'title' => $donnees['title'], 
        //   'description' => $donnees['description'],
        //   'release_year' => $donnees['release_year'],
        //   'language_id' => $donnees['language_id'],
        //   'rental_duration' => $donnees['rental_duration'],
        //   'rental_rate' => $donnees['rental_rate'],
        //   'replacement_cost' => $donnees['replacement_cost']
        //  ]);

        // return (new FilmResource($movie))
        //     ->response()
        //     ->setStatusCode(201);
        //return new FilmResource(Film::find(3));

    }

    public function storeReview(Movie $movie, Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return $movie->load('reviews');
    }

    /**
     * Display the specified resource.
     *
     * @param  Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function showActors(Movie $movie)
    {
        return $movie->actors;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie) //only if admin
    {
        
        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->actors = $request->actors;
        $movie->runtime = $request->runtime;
        $movie->genre = $request->genre;

        $movie->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie) //only if admin
    {
        $movie->delete();
    }

}