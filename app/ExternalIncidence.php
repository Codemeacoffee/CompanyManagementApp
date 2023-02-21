<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalIncidence extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'incidence', 'location', 'user', 'informant', 'contact', 'responsible' ,'solved', 'solution', 'created', 'updated'
    ];
}
