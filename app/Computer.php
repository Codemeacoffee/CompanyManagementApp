<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = [
        'code', 'name', 'brand', 'model', 'serial', 'ip', 'processor', 'memory', 'hardDrive',
        'operatingSystem', 'CD_ROM', 'status', 'location', 'originalPlacement', 'currentPlacement',
        'observations', 'deceased', 'deceaseDate', 'warranty', 'warrantyEndDate', 'provider',
        'gateway', 'DNS1', 'DNS2', 'purchaseDate', 'activationKey'
    ];
}

