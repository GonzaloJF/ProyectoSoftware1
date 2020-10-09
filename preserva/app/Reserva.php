<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $casts =[
        'bloques' => 'array'
    ];
}
