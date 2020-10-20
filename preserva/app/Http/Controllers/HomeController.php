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
            
            return view('home');
    }

    public function show()
    {   
        //$data=evento::latest()->where('id','=',98)->get();
        $data=evento::all();
        return response() ->json($data);
    }
}
