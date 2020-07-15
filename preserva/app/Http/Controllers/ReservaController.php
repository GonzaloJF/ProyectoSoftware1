<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller{
    public function create()
    {
        return view('reserva.create');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'cod_lab' => ['required', 'string', 'max:255'],
            'fecha' => ['required', 'string', 'date'],
            'bloque' => ['required', 'integer'],
            'capacidad' => ['required', 'integer'],
        ]);

        $reserva = new reserva();
        $reserva->username = $validatedData['username'];
        $reserva->name =$validatedData['name'];
        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha =$validatedData['fecha'];
        $reserva->bloque =$validatedData['bloque'];
        $reserva->capacidad =$validatedData['capacidad'];
        $reserva->save();

        $status = 'Has reservado correctamente';
        return back()->with(compact('status'));
    }
}
