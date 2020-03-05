<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if(Auth::guest()) return response()->json('Unauthorized', 401);

        dd([
            $request->user()->id,
            $user->id
        ]);
        if($user->id != $request->user()->id) {
            return response()->json("Unauthorized", 403);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::guest()) return response()->json('Unauthorized', 401);

        if($user->id != $request->user()->id) {
            return response()->json("Unauthorized", 403);
        }
    }
}
