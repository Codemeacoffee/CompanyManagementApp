<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $fillable = [
        'code', 'location', 'description', 'amount', 'status', 'observations', 'originalPlacement', 'currentPlacement'
    ];
}
