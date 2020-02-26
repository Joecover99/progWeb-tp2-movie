<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actor;

class Movie extends Model
{
    public const ratingEnum = [
        'G',
        'PG',
        'PG-13',
        'R',
        'NC-17'
    ];

    public const specialFeatures = [
        'Trailers',
        'Commentaries',
        'Deleted Scenes',
        'Behind the Scenes'
    ];

    protected $fillable = [
        'title',
        'release_year',
        'language_id',
        'rental_duration',
        'rental_rate',
        'replacement_cost'
    ];

    public function actors(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Actor::class);
    }
}
