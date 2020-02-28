<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'description',
        'release_year',
        'language_id',
        'length',
        'rating',
        'special_features'
    ];

    // Region reviews
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Review::class);
    }

    // Region Actors
    public function actors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Actor::class);
    }

    public function hasActor(Actor $actor): bool {
        return $this->actors()->find($actor->id) != null;
    }

    public function addActor(Actor $actor): void {
        if(!$this->hasActor($actor)) {
            $this->actors()->attach($actor->id);
        }
    }
}
