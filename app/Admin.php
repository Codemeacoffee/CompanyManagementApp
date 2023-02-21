<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'password', 'elevation', 'email', 'session_token'
    ];

    protected $hidden = [
        'password', 'session_token'
    ];
}
