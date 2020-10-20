<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
            'nombre_reservante' => ['required'],
            'cod_lab' => ['required'],
            'fecha_inicial' => ['required','after:yesterday'],
            'fecha_final' => ['required'],
            'bloques' => ['required'],
            'cap_res' => ['required'],
            'atomica' => ['required'],
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
        $reserva->nombre_reservante =$validatedData['nombre_reservante'];
        $reserva->cod_lab =$validatedData['cod_lab'];
        $reserva->fecha_inicial =$validatedData['fecha_inicial'];
        $reserva->fecha_final =$validatedData['fecha_final'];
        $reserva->bloques = $validatedData['bloques'];
        $reserva->cap_res =$validatedData['cap_res'];
        
        $fechaini =$validatedData['fecha_inicial'];
        $fechafin =$validatedData['fecha_final'];
        
        $total_bloque = $validatedData['bloques'];
        $dia1=$fechaini;

        //VERIFICAR SI ESTA TODO DISPONIBLE CUANDO ES ATOMICA
        if($validatedData['atomica'] == 'si'){
            //dd($validatedData['atomica']);
            while($dia1 <= $fechafin){
                foreach ($total_bloque as &$bloque_ind) {
                    //---------------------------   LUNES--------------------
                    if((carbon::parse($dia1)->dayOfWeek )=='1'){
                        //print_r($dia1);
                    
                        if($bloque_ind == 'lunes1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){

                            }
                        }

                        if($bloque_ind == 'lunes10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'lunes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){

                            }
                        }

                        if($bloque_ind == 'lunes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'lunes12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                    }
        //-------------------------- MARTES ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='2'){
                                        
                        if($bloque_ind == 'martes1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'martes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'martes12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                    }
    //-------------------- MIERCOLES -----------               
                    if((carbon::parse($dia1)->dayOfWeek )=='3'){
                        if($bloque_ind == 'miercoles1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'miercoles11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'miercoles12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }                               
                        
                        
                    }

    //-------------------- JUEVES----------------
                    if((carbon::parse($dia1)->dayOfWeek )=='4'){
                    
                        if($bloque_ind == 'jueves1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'jueves11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'jueves12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                                        
                                        
                    }

    //-------------------- Viernes----------------
                    if((carbon::parse($dia1)->dayOfWeek )=='5'){
                                                                                        
                        if($bloque_ind == 'viernes1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'viernes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'viernes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $evento= new evento();
                                $evento->cod_lab =$validatedData['cod_lab'];
                                $evento->title = 'Bloque 11';
                                $evento->start = $dia1;
                                $evento->nombre_reservante = $validatedData['nombre_reservante'];
                                $evento->save();
                                
                            }
                        }

                        if($bloque_ind == 'viernes12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }                             
                                                        
                    }

    //-------------------- Sabado----------------
                    if((carbon::parse($dia1)->dayOfWeek )=='6'){
                                                                                        
                        if($bloque_ind == 'sabado1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }
                        
                        if($bloque_ind == 'sabado11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }

                        if($bloque_ind == 'sabado12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $error="Hay un bloque con el mismo dia ocupado en este laboratorio";
                                return back()->with(compact('error')); 
                            }
                        }                               
                                                        
                    }   

                }
            
                $dia1=Carbon::parse($dia1)->addDays(1);
            }
        }

//--------------------------------------------- INGRESO DE EVENTOS -------------------------------------------

        $dia=$fechaini;
        $diafinal=Carbon::parse($fechafin)->addDays(1);


        while($dia < $diafinal ){
                        
            foreach ($total_bloque as &$bloque_ind) {
    //---------------------------   LUNES--------------------
                if((carbon::parse($dia)->dayOfWeek )=='1'){
                    //print_r($dia);
                
                    if($bloque_ind == 'lunes1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'lunes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'lunes12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                }
    //-------------------------- MARTES ------------------- 
                if((carbon::parse($dia)->dayOfWeek )=='2'){
                                    
                    if($bloque_ind == 'martes1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'martes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'martes12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                }
//-------------------- MIERCOLES -----------               
                if((carbon::parse($dia)->dayOfWeek )=='3'){
                    if($bloque_ind == 'miercoles1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'miercoles11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'miercoles12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }                               
                    
                    
                }

//-------------------- JUEVES----------------
                if((carbon::parse($dia)->dayOfWeek )=='4'){
                  
                    if($bloque_ind == 'jueves1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'jueves11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'jueves12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                                    
                                    
                }

//-------------------- Viernes----------------
                if((carbon::parse($dia)->dayOfWeek )=='5'){
                                                                                    
                    if($bloque_ind == 'viernes1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'viernes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'viernes12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }                             
                                                    
                }

//-------------------- Sabado----------------
                if((carbon::parse($dia)->dayOfWeek )=='6'){
                                                                                    
                    if($bloque_ind == 'sabado1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 2';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 3';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 4';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 5';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 6';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 7';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 8';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 9';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 10';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }
                    
                    if($bloque_ind == 'sabado11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 11';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }

                    if($bloque_ind == 'sabado12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 12';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->save();
                            
                        }
                    }                               
                                                    
                }

            }
            $dia=Carbon::parse($dia)->addDays(1);
        }
        
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
