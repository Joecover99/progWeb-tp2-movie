<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;
use Illuminate\Validation\Rule;

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
        // Validate data
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'release_year' => 'required|integer',
            'length' => 'required|integer|min:0',
            'description' => 'required',
            'rating' => [ Rule::in(Movie::ratingEnum) ],
            'language_id' => [
                'required',
                'integer',
                Rule::exists('languages', 'id')
            ],
            'special_features' => [
                Rule::in(Movie::specialFeatures)
            ],
            'image' => [
                //nothing
            ]
        ]);

        Movie::create($validatedData);

        return response()->json('', 201);
    }

    /**
     * Store a new review for a specific movie.
     *
     * @param Movie $movie
     * @param Request $request
     * @return void
     */
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