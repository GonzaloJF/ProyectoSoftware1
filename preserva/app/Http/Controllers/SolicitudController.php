<?php

namespace App\Http\Controllers;

use App\solicitud;
use App\laboratorio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{   
    public function __construct()
    {       
            $this->middleware('solicitud_middleware');

        
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
        $laboratorios = laboratorio::orderBy('id')->Paginate();
        return view('solicitud.create',compact('laboratorios'));
    }

    public function solicitudes_anteriores()
    {
               
        $solicitudes = solicitud::where('username','=',Auth::user()->username)->orderByDesc('id')->Paginate(10);
        return view('solicitud',compact('solicitudes'));
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
            'fecha' => ['required','after:today'],
            'bloque' => ['required'],
            'cap_sol' => ['required'],
        ]);
        $solicitud = new solicitud();
        $solicitud->username = $validatedData['username'];
        $solicitud->nombre_completo =$validatedData['nombre_completo'];
        $solicitud->cod_lab =$validatedData['cod_lab'];
        $solicitud->fecha =$validatedData['fecha'];
        $solicitud->bloque =$validatedData['bloque'];
        $solicitud->cap_sol =$validatedData['cap_sol'];
        $solicitud->save();

        $status = 'Has solicitado correctamente';
        return back()->with(compact('status'));
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
        //
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
        //
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
