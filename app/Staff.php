<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
      'id', 'name', 'address', 'city', 'postal_code', 'nif', 'social_security', 'birth_date', 'phone', 'bank', 'CC', 'marital_status', 'children', 'email'
    ];

    public function scopeExclude($query,$value = array())
    {
        return $query->select( array_diff( $this->fillable,(array) $value) );
    }
}
