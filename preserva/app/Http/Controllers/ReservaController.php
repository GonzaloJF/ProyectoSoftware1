<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ReservaController extends Controller
{

    public function __construct()
    {       
            $this->middleware('auth');

        
    }
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

    public function reservas_anteriores()//Busca las reservas hechas anteriormente
    {
        if((Auth::user()->tipo_usuario)==5):
            $reservas = reserva::where('username','=',Auth::user()->username)->orderByDesc('id')->Paginate(10);
            return view('reserva',compact('reservas'));
        else:
            $reservas = reserva::orderByDesc('id')->Paginate(10);
            return view('reserva',compact('reservas'));
        endif;       
        
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Toma los datos de la nueva reserva y los agrega a la base de datos
    public function store(Request $request)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'nombre_reservante' => ['required'],
            'cod_lab' => ['required'],
            'fecha' => ['required'],
            'bloque' => ['required'],
            'cap_res' => ['required'],
        ]);
        $reserva = new reserva();
        $reserva->username = $validatedData['username'];
        $reserva->nombre_completo =$validatedData['nombre_completo'];
        $reserva->nombre_reservante =$validatedData['nombre_reservante'];
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
        return view('reserva.edit',compact('reserva'));
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
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'cod_lab' => ['required'],
            'fecha' => ['required'],
            'bloque' => ['required'],
            'cap_res' => ['required'],
        ]);


        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha =$validatedData['fecha'];
        $reserva->bloque =$validatedData['bloque'];
        $reserva->cap_res =$validatedData['cap_res'];
        $reserva->save();

        $status = 'Has editado correctamente';
        return back()->with(compact('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */

     //
    public function destroy($id)
    {   
        if((Auth::user()->tipo_usuario)==5):
            return redirect('reserva');
        else:
            Reserva::destroy($id);
            return redirect('reserva');
        endif;
    }
}
