<?php

namespace App\Http\Controllers;

use App\movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return MovieResource::collection(Movie::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $film = Film::find($id);
        $film->update($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if(Auth::check() && Auth::user()->isAdmin()){ // A VOIR POUR UNE AUTRE OPTION
            $film = Film::create($request->all());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie) {
        //return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie) {
        if(Auth::check() && Auth::user()->isAdmin()) //VOIR UNE AUTRE OPTION
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $film = Film::find($id);
        $film->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie) {
        if(Auth::check() && Auth::user()->isAdmin()){//VOIR UNE AUTRE OPTION
            Film::findOrFail($id)->delete();
    }
}