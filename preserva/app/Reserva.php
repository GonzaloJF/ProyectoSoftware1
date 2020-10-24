<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $casts =[
        'bloques' => 'array'
    ];

    protected $fillable = [
        'username', 'nombre_reservante', 'cod_lab','fecha_inicial', 'fecha_final', 'bloques', 'cap_res', 'ciudad',
    ];
}
