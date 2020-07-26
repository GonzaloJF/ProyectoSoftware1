<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function usuarios()
    {
        $usuarios = user::orderByDesc('id')->Paginate(10);
        return view('usuarios',compact('usuarios'));
    }

}
