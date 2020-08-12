<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;

class CambiopassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function cambiopass()
    {
        return view('home.cambiopass');
    }
    
    public function cambiopass_actualizar(Request $request)
    {
        
        
        if(!(Hash::check($request->get('password'),Auth::user()->password))){
            return back()->with('error','Esta Contraseña no corresponde a la actual');
        }
        if(strcmp($request->get('password'),$request->get('new-password'))==0)
        {
            return back()->with('error','La contraseña no puede ser igual a la anterior');
        }
        if (($request->get('new-password'))!=($request->get('password_confirmation'))) 
        {
            return back()->with('error','Las confirmacion no coincide');
        }
        $validatedData = $request->validate([
            'password' => ['required','min:3'],
            'new-password' => ['required','min:3'],
            'password_confirmation' => ['required','min:3'],
        ]);
        $user= Auth::user();
        $user->password =Hash::make($validatedData['new-password']);
        $user->save();
        return back()->with('message','Has cambiado la contraseña correctamente');
    }
}