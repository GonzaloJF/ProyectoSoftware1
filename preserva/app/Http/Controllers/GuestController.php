<?php

namespace App\Http\Controllers;

use App\reserva;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        
        return view('welcome');
    }
}
