<?php

namespace App\Http\Controllers;

use App\laboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{

    public function __construct()
    {       
    
        $this->middleware('admin');
        
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

        return view('laboratorio.create');
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
             'Codigo_de_laboratorio' => ['required', 'unique:laboratorios'],
             'Capacidad' => ['required'],
             'Facultad' => ['required'],
             'Tipo_laboratorio' => ['required'],
         ]);
         $laboratorio = new laboratorio();
         $laboratorio->Codigo_de_laboratorio = $validatedData['Codigo_de_laboratorio'];
         $laboratorio->Capacidad =$validatedData['Capacidad'];
         $laboratorio->Facultad =$validatedData['Facultad'];
         $laboratorio->Tipo_laboratorio =$validatedData['Tipo_laboratorio'];
         $laboratorio->save();
 
         $status = 'Has creado correctamente';
         return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show(laboratorio $laboratorio)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(laboratorio $laboratorio)
    {
        return view('laboratorio.edit',compact('laboratorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laboratorio $laboratorio)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'Capacidad' => ['required'],
            'Facultad' => ['required'],
            'Tipo_laboratorio' => ['required'],
        ]);
        $laboratorio->Capacidad =$validatedData['Capacidad'];
        $laboratorio->Facultad =$validatedData['Facultad'];
        $laboratorio->Tipo_laboratorio =$validatedData['Tipo_laboratorio'];
        $laboratorio->save();

        $status = 'Has editado correctamente';
        return back()->with(compact('status'));
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(laboratorio $laboratorio)
    {
        //
    }
}
