<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{

    protected $fillable = [
        'exit_code', 'document' ,'date', 'destination', 'sender'
    ];

}
