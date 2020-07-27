<?php

namespace App\Http\Controllers;

use App\solicitud;
use App\Reserva;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{   
    public function __construct()
    {       
            $this->middleware('encargado_middleware');

        
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
        //return view('solicitud.create');
    }

    public function solicitudes_anteriores()
    {
               
        $solicitudes = solicitud::orderByDesc('id')->Paginate(10);
        return view('evaluacion',compact('solicitudes'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(solicitud $solicitud)
    {
        return view('evaluacion.edit',compact('solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, solicitud $solicitud)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'cod_lab' => ['required'],
            'fecha' => ['required'],
            'bloque' => ['required'],
            'cap_sol' => ['required'],
            'estado' => ['required'],
        ]);
        
        /*$solicitud->username = $validatedData['username'];
        $solicitud->nombre_completo =$validatedData['nombre_completo'];
        $solicitud->cod_lab =$validatedData['cod_lab'];
        $solicitud->fecha =$validatedData['fecha'];
        $solicitud->bloque =$validatedData['bloque'];
        $solicitud->cap_sol =$validatedData['cap_sol'];*/
        $solicitud->estado =$validatedData['estado'];
        $solicitud->save();

        $reserva = new reserva();
        $reserva->username = (auth::user()->username);
        $reserva->nombre_completo =(auth::user()->name.' '.auth::user()->apellido);
        $reserva->nombre_reservante =$validatedData['nombre_completo'];
        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha =$validatedData['fecha'];
        $reserva->bloque =$validatedData['bloque'];
        $reserva->cap_res =$validatedData['cap_sol'];
        $reserva->save();

        $status = 'Has evaluado y reservado correctamente';
        return back()->with(compact('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(solicitud $solicitud)
    {
        //
    }
}
