<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'location', 'placement', 'date', 'cause', 'observations'
    ];
}
