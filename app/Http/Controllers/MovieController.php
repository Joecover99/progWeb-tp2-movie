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
    public function index()
    {
        return FilmResource::collection(Film::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Web Page   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1) || $row["role"] == 1){
            $movie = Film::create($request->all());
            }
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
        //Consultation de tous les acteurs d’un certain film
        $movie = FilmResource(Film::find($id));
        if($movie){[
            'title' => $donnees['title'], 
            'description' => $donnees['description'],
            'release_year' => $donnees['release_year'],
            'critiques' => $donnees['critiques']
        ]}else{
            return("your movie can't be found");
        };
        /*
        public function show($id)
        {
        $movie=Movie::find($id);
        if($movie){
        return response()->json(['status'=>true,'movie'=>$movie]);
        }else{
        return response()->json(['status'=>false]);
        }
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Modification d’un film; tous les champs sont modifiables à l’exception de l’identifiant
        //du film, bien sûr (seulement si admin)

        //*************Voir avec la méthode passport **********************
        /*if(Auth::check() && Auth::user()->isAdmin()){*/
            $movie = Movie::findOrFail($id);
            return view('movies.edit')->withMovie($movie);
        /*}*/
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
    Film::findOrFail($id)->delete();

    return redirect(route('home'));
    }