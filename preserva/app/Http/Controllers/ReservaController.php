<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reserva.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'cod_lab' => ['required'],
            'fecha' => ['required'],
            'bloque' => ['required'],
            'cap_res' => ['required'],
        ]);
        $reserva = new reserva();
        $reserva->username = $validatedData['username'];
        $reserva->nombre_completo =$validatedData['nombre_completo'];
        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha =$validatedData['fecha'];
        $reserva->bloque =$validatedData['bloque'];
        $reserva->cap_res =$validatedData['cap_res'];
        $reserva->save();

        $status = 'Has reservado correctamente';
        return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
