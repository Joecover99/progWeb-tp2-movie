<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public $timestamps = false;

    protected $hidden = [
        'pivot'
    ];
    
    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate'
    ];
}
