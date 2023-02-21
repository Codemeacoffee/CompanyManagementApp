<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceIncidence extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'incidence', 'location', 'user', 'informant', 'responsible' ,'solved', 'solution', 'created', 'updated'
    ];
}
