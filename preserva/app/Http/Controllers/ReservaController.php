<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\laboratorio;
use App\evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ReservaController extends Controller
{

    public function __construct()
    {       
            $this->middleware('auth');

        
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
        $laboratorios = laboratorio::orderBy('id')->Paginate();
        return view('reserva.create',compact('laboratorios'));
    }

    public function reservas_anteriores(Request $request)//Busca las reservas hechas anteriormente
    {
        //dd($request->all());
        $laboratorios = laboratorio::orderBy('id')->Paginate();
        $lab_buscar= $request->get('buscar_lab');
        $fecha_buscar=$request->get('fecha_buscar');
        
        if((Auth::user()->tipo_usuario)==5):
            if(($request->buscar_lab!='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->where('cod_lab','like',"%$lab_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->where('fecha_inicial','like',"%$fecha_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab!='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->where('cod_lab','like',"%$lab_buscar%")->where('fecha','=',"%$fecha_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            };
        else:
            if(($request->buscar_lab!='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('fecha_inicial','like',"%$fecha_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab!='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->where('fecha_inicial','=',"%$fecha_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            };
            if(($request->buscar_lab=='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            };
        endif;       
        
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Toma los datos de la nueva reserva y los agrega a la base de datos
    public function store(Request $request)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'nombre_reservante' => ['required'],
            'cod_lab' => ['required'],
            'fecha_inicial' => ['required','after:yesterday'],
            'fecha_final' => ['required'],
            'bloques' => ['required'],
            'cap_res' => ['required'],
        ]);
        /*
        if((reserva::where('cod_lab','=',$validatedData['cod_lab'])->where('fecha','=',$validatedData['fecha'])->where('bloque','=',$validatedData['bloque'])->count())>0){
            $error="El laboratorio ya esta reservado ese dia y en ese bloque";
            return back()->with(compact('error'));
            
        }
        
        if((laboratorio::where('Codigo_de_laboratorio','=',$validatedData['cod_lab'])->where('capacidad','<',$validatedData['cap_res'])->count())>0){
            $error="La capacidad ingresada es superior a la del laboratorio";
            return back()->with(compact('error'));
        };*/

        $reserva = new reserva();
        $reserva->username = $validatedData['username'];
        $reserva->nombre_completo =$validatedData['nombre_completo'];
        $reserva->nombre_reservante =$validatedData['nombre_reservante'];
        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha_inicial =$validatedData['fecha_inicial'];
        $reserva->fecha_final =$validatedData['fecha_final'];
        $reserva->bloques = $validatedData['bloques'];
        $reserva->cap_res =$validatedData['cap_res'];
        
        $fechaini =$validatedData['fecha_inicial'];
        $fechafin =$validatedData['fecha_final'];

        $evento= new evento();
        $evento->cod_lab =$validatedData['cod_lab'];
        $evento->title = 'reserva';
        $evento->rrule = "DTSTART:$fechaini\nRRULE:FREQ=WEEKLY;UNTIL=$fechafin;BYWEEKDAY=WE";
        $evento->save();
        $reserva->save();

        $status = 'Has reservado correctamente';
        return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva) 
    {
        return view('reserva.edit',compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    /* */

    public function update(Request $request, Reserva $reserva) //Funcion que actualiza los datos de la reserva
    {
        
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_completo' => ['required'],
            'cod_lab' => ['required'],
            'fecha_inicial' => ['required'],
            'bloque' => ['required'],
            'cap_res' => ['required'],
        ]);


        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha_inicial =$validatedData['fecha_inicial'];
        $reserva->bloque =$validatedData['bloque'];
        $reserva->cap_res =$validatedData['cap_res'];
        $reserva->save();
        
        $fecha = $validatedData['fecha_inicial'];
        $status = 'Has editado correctamente';
        return back()->with(compact('status','fecha'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */

     //
    public function destroy($id) //Funcion que elimina los datos de la reserva
    {   
        if((Auth::user()->tipo_usuario)==5):
            return redirect('reserva');
        else:
            Reserva::destroy($id);
            return redirect('reserva');
        endif;
    }
}
