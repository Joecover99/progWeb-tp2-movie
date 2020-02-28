<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'score',
        'comment'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
