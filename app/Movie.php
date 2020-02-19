<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'release_year',
        'language_id',
        'rental_duration',
        'rental_rate',
        'replacement_cost'
    ];
}
