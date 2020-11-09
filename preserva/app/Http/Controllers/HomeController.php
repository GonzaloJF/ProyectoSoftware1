<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\laboratorio;
use App\evento;
use App\user;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)//Busca las reservas hechas anteriormente
    {
            $lab_buscar= $request->get('buscar_lab');
            $laboratorios = laboratorio::orderBy('id')->get();
            $eventos=[];
            if($request->buscar_lab!='Todos'){
                $data=evento::latest()->where('cod_lab','like',"%$lab_buscar%")->get();
                $todos_eventos=$data->toArray();
                foreach ($todos_eventos as $evento_solo ) {
             
                    $eventos[]=[   'title' =>[$evento_solo['title'].' '.$evento_solo['cod_lab']."\n".$evento_solo['nombre_reservante']],
                            'start' => $evento_solo['start'],
                            'url' => '/home/'.$evento_solo['id'].'/info',
                        ];
                        
                    }
                return view('home',compact('laboratorios','eventos'));
            }
            if($request->buscar_lab=='Todos'){
                $data=evento::all();
                $todos_eventos=$data->toArray();
                foreach ($todos_eventos as $evento_solo ) {
             
                    $eventos[]=[   'title' =>[$evento_solo['title'].' '.$evento_solo['cod_lab'].'\n'.$evento_solo['nombre_reservante']],
                            'start' => $evento_solo['start'],
                            'url' => '/home/'.$evento_solo['id'].'/info',
                        ];
                        
                    }
                
                return view('home',compact('laboratorios','eventos'));
            }
                       
            
    }

    public function info_evento(Evento $evento) 
    {
        $reserva = Reserva::where('id',$evento->id_reserva)->first();
        $usuario = User::where('username',$reserva->username)->first();
        return view('home.info_evento',compact('evento','reserva','usuario'));
    }


}
