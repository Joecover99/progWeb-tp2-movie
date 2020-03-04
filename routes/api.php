<?php

use App\Http\Controllers\MovieController;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//CRUD
Route::apiResource('movies', 'MovieController');

Route::get('movies/{movie}/actors', [
    'as' => 'movies.show.actors',
    'uses' => 'MovieController@showActors'
]);

Route::post('movies/{id}/reviews', function ($movieId) {
    // $movie = Movie::findOrFail($movieId);
    // $user = Auth::user();
    return 'yyet';
}); //->middleware('auth');