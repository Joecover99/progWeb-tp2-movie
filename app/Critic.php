<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critic extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'score',
        'comment'
    ];
}
