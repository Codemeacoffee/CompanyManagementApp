<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $connection = 'mysql2';

    protected $fillable = [
        'name', 'type', 'email', 'phone', 'location', 'entity', 'content', 'info', 'status'
    ];
}
