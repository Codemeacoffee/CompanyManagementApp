<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormativeAction extends Model
{

    protected $fillable = [
        'name', 'type', 'speciality' ,'year', 'closed'
    ];

}
