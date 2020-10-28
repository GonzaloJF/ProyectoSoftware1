<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evento extends Model
{
    protected $fillable = [
        'id','cod_lab', 'title', 'start','nombre_reservante', 'bloque', 'id_reserva',
    ];

}
