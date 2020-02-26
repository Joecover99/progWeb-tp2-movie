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
    public function index()
    {
        return MovieResource::collection(Movie::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

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
    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();
    }
}