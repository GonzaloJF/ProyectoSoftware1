<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use App\laboratorio;
use App\evento;

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
        //dd($request->all());
        /*$laboratorios = laboratorio::orderBy('id')->Paginate();
        $lab_buscar= $request->get('buscar_lab');
        $fecha_buscar=$request->get('fecha_buscar');
            if(($request->buscar_lab!='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->where('fecha','>=',today())->orderBy('fecha')->Paginate(10);
                return view('home',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('fecha','like',"%$fecha_buscar%")->where('fecha','>=',today())->orderBy('fecha')->Paginate(10);
                return view('home',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab!='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->where('fecha','=',"%$fecha_buscar%")->where('fecha','>=',today())->orderBy('fecha')->Paginate(10);
                return view('home',compact('reservas','laboratorios'));
            };
            if(($request->buscar_lab=='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::orderBy('fecha')->where('fecha','>=',today())->Paginate(10);
                return view('home',compact('reservas','laboratorios'));
            };*/
            /*$events = [];
            $eventos = evento::orderBy('id')->get();
            $eventito =  $eventos->get();
            dd($eventito);*/
            $lab_buscar= $request->get('buscar_lab');
            $laboratorios = laboratorio::orderBy('id')->get();
            $eventos=[];
            if($request->buscar_lab!='Todos'){
                $data=evento::latest()->where('cod_lab','like',"%$lab_buscar%")->get();
                $todos_eventos=$data->toArray();
                foreach ($todos_eventos as $evento_solo ) {
             
                    $eventos[]=[   'title' =>[$evento_solo['title'].' '.$evento_solo['cod_lab']."\n".$evento_solo['nombre_reservante']],
                            'start' => $evento_solo['start'],
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
                        ];
                        
                    }
                return view('home',compact('laboratorios','eventos'));
            }
            
            
            
            /*foreach ($todos_eventos as $evento_solo ) {
             
            $eventos[]=[   'title' =>$evento_solo['title'],
                    'start' => $evento_solo['start'],
                ];

            }*/
            //dd($eventos);
            
            
    }

    /*public function show(laboratorio $laboratorio)
    {   
        //$data=evento::latest()->where('id','=',98)->get();
        
        
        $data=evento::all();
        $eventos=$data->toArray();
        
    
        return response() ->json($data);
    }*/
}
