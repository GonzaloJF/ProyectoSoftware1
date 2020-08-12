<?php

namespace App\Http\Controllers;

use App\reserva;
use App\laboratorio;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        
        return view('welcome');
    }

    public function show(laboratorio $laboratorio)
    {
        $laboratorios = laboratorio::orderBy('id')->Paginate(10);
        return view('laboratorio',compact('laboratorios'));
    }
}
