<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostMovieRequest;
use App\Http\Requests\PostReviewRequest;
use App\Movie;
use Illuminate\Http\Request;
use App\Http\Resources\Movie as MovieResource;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'min_length' => 'integer|min:0',
            'max_length' => 'integer|min:0',
            'key_word' => '',
            'rating' => [
                Rule::in(Movie::ratingEnum)
            ]
        ]);


        $query = Movie::query();
        
        if(array_has($validatedData,'min_length')) {
            $query = $query->where('length', '>=', $validatedData['min_length']);
        }

        if(array_has($validatedData,'max_length')) {
            $query = $query->where('length', '<=', $validatedData['max_length']);
        }

        if(array_has($validatedData,'key_word')) {
            $keyWord = $validatedData['key_word'];
            $query = $query->where(function($query) use ($keyWord) {
                $query->where('title', 'like', '%'.$keyWord.'%')
                ->orWhere('description', 'like', '%'.$keyWord.'%');
            });
        }

        if(array_has($validatedData,'rating')) {
            $query = $query->where('rating', '=', $validatedData['rating']);
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
    public function store(Request $request)
    {
        if(Auth::guest())
            return response()->json('Unauthorized', 401);

        if(!Auth::user()->is_admin)
            return response()->json('Unauthorized', 403);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'release_year' => 'required|integer',
            'length' => 'required|integer|min:0',
            'description' => 'required',
            'rating' => [
                Rule::in(Movie::ratingEnum)
            ],
            'language_id' => [
                'required',
                'integer',
                Rule::exists('languages', 'id')
            ],
            'special_features' => [
                'nullable',
                Rule::in(Movie::specialFeatures)
            ],
            'image' => [
                //nothing
            ]
        ]);

        if($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        Movie::create($validator->validated());

        return response()->json('Success', 201);
    }

    /**
     * Store a new review for a specific movie.
     *
     * @param Movie $movie
     * @param Request $request
     * @return void
     */
    public function storeReview(Movie $movie, PostReviewRequest $request) {
        if(Auth::guest()) return response()->json('Unauthorized', 401);

        $reviewAttributes = $request->validated();
        $reviewAttributes['user_id'] = Auth::user();

        $movie->reviews()->create($reviewAttributes);
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
    public function update(PostMovieRequest $request, Movie $movie) //only if admin
    {
        $validatedData = $request->validated();

        $movie->title = $validatedData->title;
        $movie->director = $validatedData->director;
        $movie->actors = $validatedData->actors;
        $movie->runtime = $validatedData->runtime;
        $movie->genre = $validatedData->genre;

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
        if(Auth::guest()) return response()->json('Unauthorized', 401);

        $movie->delete();
    }

}