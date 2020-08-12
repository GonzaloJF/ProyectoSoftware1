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

    public function edit(User $usuario)
    {
        return view('usuarios.edit',compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        
        $validatedData = $request->validate([
            'name' => ['required'],
            'apellido' => ['required'],
            'tipo_usuario' => ['required'],
            'estado' => ['required'],
            'ciudad' => ['required'],
        ]);


        $usuario->name =$validatedData['name'];
        $usuario->apellido =$validatedData['apellido'];
        $usuario->tipo_usuario =$validatedData['tipo_usuario'];
        $usuario->estado =$validatedData['estado'];
        $usuario->ciudad =$validatedData['ciudad'];
        $usuario->save();

        $status = 'Has editado el usuario correctamente';
        return back()->with(compact('status'));
    }

    public function destroy($username)
    {   
            User::destroy($username);
            return redirect('usuarios');
    }
    

}
