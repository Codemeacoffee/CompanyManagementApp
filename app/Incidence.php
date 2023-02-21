<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'code', 'incidence', 'observations', 'location', 'user', 'informant', 'solved', 'solution', 'created', 'updated'
    ];
}
