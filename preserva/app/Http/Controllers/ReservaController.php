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
        dd($request->all());
    }
}
