<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{

    protected $fillable = [
        'receiver', 'entry_code', 'document' ,'date', 'destination', 'sender'
    ];

}
