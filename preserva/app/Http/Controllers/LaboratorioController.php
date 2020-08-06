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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show(laboratorio $laboratorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(laboratorio $laboratorio)
    {
        //
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
        //
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
