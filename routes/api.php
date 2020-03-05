<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// User
Route::post('login', [ 'as' => 'api.login', 'uses' => 'Auth\LoginController@login' ]);
Route::post('register', [ 'as' => 'api.register', 'uses' => 'Auth\RegisterController@register' ]);
Route::get('users/{id}', [ 'as' => 'api.curentUser', 'uses' => 'UserController@index' ]);
Route::patch('users/{id}', [ 'as' => 'api.curentUser.update', 'uses' => 'UserController@update' ]);


// Movies
Route::apiResource('movies', 'MovieController');
Route::get('movies/{id}/actors', [ 'as' => 'movies.show.actors', 'uses' => 'MovieController@showActors' ]);
Route::post('movies/{id}/reviews', [ 'as' => 'movies.show.actors', 'uses' => 'MovieController@storeReview']);