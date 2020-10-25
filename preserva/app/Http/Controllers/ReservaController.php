<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Reserva;
use App\User;
use App\laboratorio;
use App\evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionReservaEliminada;
use App\Mail\NotificacionPeriodoEliminado;

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
        $laboratorios = laboratorio::orderBy('id')->Paginate();
        $lab_buscar= $request->get('buscar_lab');
        $fecha_buscar=$request->get('fecha_buscar');
        //--------------Encargado-----------
            if((Auth::user()->tipo_usuario)==3){
                if(($request->buscar_lab!='Todos')&&($fecha_buscar==NULL)){
                    $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->orderByDesc('id')->Paginate(10);
                    return view('reserva',compact('reservas','laboratorios'));
                }
                if(($request->buscar_lab=='Todos')&&($fecha_buscar!=NULL)){
                    $reservas = reserva::whereDate('fecha_inicial','<=',$request['fecha_buscar'])->whereDate('fecha_final','>=',$request['fecha_buscar'])->orderByDesc('id')->Paginate(10);
                    return view('reserva',compact('reservas','laboratorios'));
                }
                if(($request->buscar_lab!='Todos')&&($fecha_buscar!=NULL)){
                    $reservas = reserva::where('cod_lab','like',"%$lab_buscar%")->whereDate('fecha_inicial','<=',$request['fecha_buscar'])->whereDate('fecha_final','>=',$request['fecha_buscar'])->orderByDesc('id')->Paginate(10);
                    return view('reserva',compact('reservas','laboratorios'));
                }
                if(($request->buscar_lab=='Todos')&&($fecha_buscar==NULL)){
                    $reservas = reserva::orderByDesc('id')->Paginate(10);
                    return view('reserva',compact('reservas','laboratorios'));
                }
            }
        //----------------Todos------------- 
            if(($request->buscar_lab!='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->where('cod_lab','like',"%$lab_buscar%")->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->whereDate('fecha_inicial','<=',$request['fecha_buscar'])->whereDate('fecha_final','>=',$request['fecha_buscar'])->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab!='Todos')&&($fecha_buscar!=NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->where('cod_lab','like',"%$lab_buscar%")->whereDate('fecha_inicial','<=',$request['fecha_buscar'])->whereDate('fecha_final','>=',$request['fecha_buscar'])->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }
            if(($request->buscar_lab=='Todos')&&($fecha_buscar==NULL)){
                $reservas = reserva::where('username','=',Auth::user()->username)->orderByDesc('id')->Paginate(10);
                return view('reserva',compact('reservas','laboratorios'));
            }

    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function verificar($total_bloque,$fechaini,$fechafin,$validatedData ){
        $cantidad=[];
        $dia1=$fechaini;
        while($dia1 <= $fechafin){
            foreach ($total_bloque as $bloque_ind) {
                //dd($total_bloque,$bloque_ind);
                //---------------------------LUNES--------------------
                    if((carbon::parse($dia1)->dayOfWeek )=='1'){
                        //print_r($dia1);
                        $nombre_dia='Lunes';
                        if($bloque_ind == 'lunes1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $fecha_dia = $dia->format('Y-M-D');
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $fecha_dia = $dia->format('Y-M-D');
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')];
                            }
                        }
                        
                        if($bloque_ind == 'lunes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'lunes12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')];
                            }
                        }
                    
                    }
                //-------------------------- MARTES ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='2'){
                    $nombre_dia='Martes';                
                    if($bloque_ind == 'martes1'){
                        
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes2'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes3'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes4'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes5'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }

                    if($bloque_ind == 'martes6'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes7'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }

                    if($bloque_ind == 'martes8'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }

                    if($bloque_ind == 'martes9'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }

                    if($bloque_ind == 'martes10'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }
                    
                    if($bloque_ind == 'martes11'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                        }
                    }

                    if($bloque_ind == 'martes12'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                            $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')]; 
                        }
                    }
                    
                    }
                //-------------------------- Miercoles ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='3'){
                        $nombre_dia='Miercoles';
                                        
                        if($bloque_ind == 'miercoles1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'miercoles6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'miercoles8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'miercoles9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'miercoles10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                        if($bloque_ind == 'miercoles11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'miercoles12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                    }
                //-------------------------- Jueves ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='4'){
                        $nombre_dia='Jueves';
                                        
                        if($bloque_ind == 'jueves1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'jueves6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'jueves8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'jueves9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'jueves10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                        if($bloque_ind == 'jueves11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'jueves12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                    }
                //-------------------------- Viernes ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='5'){
                        $nombre_dia='Viernes';
                                        
                        if($bloque_ind == 'viernes1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'viernes6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'viernes8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'viernes9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'viernes10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                        if($bloque_ind == 'viernes11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'viernes12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                    
                    }
                //-------------------------- Sabado ------------------- 
                    if((carbon::parse($dia1)->dayOfWeek )=='6'){
                        $nombre_dia='Sabado';
                                        
                        if($bloque_ind == 'sabado1'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 1'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado2'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 2')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 2'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado3'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 3')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 3'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado4'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 4')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 4'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado5'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 5')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 5'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'sabado6'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 6')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 6'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado7'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 7')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 7'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'sabado8'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 8')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 8'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'sabado9'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 9')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 9'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }

                        if($bloque_ind == 'sabado10'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 10')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 10'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                        
                        if($bloque_ind == 'sabado11'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 11')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 11'.' '.$dia1->format('Y-M-d')];
                            }
                        }

                        if($bloque_ind == 'sabado12'){
                            if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 12')->where('start','=',$dia1)->count())>0){
                                $cantidad[] = ['dia_bloque' => $nombre_dia.' '.'Bloque 12'.' '.$dia1->format('Y-M-d')]; 
                            }
                        }
                    
                    }

                
            }
            $dia1=Carbon::parse($dia1)->addDays(1);
        }
        //dd($cantidad);
        return ($cantidad);
         

     }

     public function guardar($fechaini,$fechafin,$total_bloque,$validatedData,$reserva){
        $dia=$fechaini;
        $diafinal=Carbon::parse($fechafin)->addDays(1);
        $reserva->save();
        while($dia < $diafinal ){
                        
            foreach ($total_bloque as &$bloque_ind) {
    //---------------------   LUNES--------------------
                if((carbon::parse($dia)->dayOfWeek )=='1'){
                    //print_r($dia);
                
                    if($bloque_ind == 'lunes1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
                            $evento->save();
                            
                        }
                    }
                    
                }
    //--------------------- MARTES ------------------- 
                if((carbon::parse($dia)->dayOfWeek )=='2'){
                                    
                    if($bloque_ind == 'martes1'){
                        if((evento::where('cod_lab','=',$validatedData['cod_lab'])->where('title','=','Bloque 1')->where('start','=',$dia)->count())==0){
                            $evento= new evento();
                            $evento->cod_lab =$validatedData['cod_lab'];
                            $evento->title = 'Bloque 1';
                            $evento->start = $dia;
                            $evento->nombre_reservante = $validatedData['nombre_reservante'];
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
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
                            $evento->id_reserva =$reserva['id'];
                            $evento->save();
                            
                        }
                    }                               
                                                    
                }

        }
        $dia=Carbon::parse($dia)->addDays(1);
        }
     }
    

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
            $datos = $this->verificar($total_bloque,$fechaini,$fechafin,$validatedData);
            if($datos){
                return back()->with(compact('datos')); 
            };
        }
        

    //--------------------------------------------- INGRESO DE EVENTOS -------------------------------------------

        $dia=$fechaini;
        $diafinal=Carbon::parse($fechafin)->addDays(1);
        $reserva->save();
        $this->guardar($fechaini,$fechafin,$total_bloque,$validatedData,$reserva);

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
    public function cambio_fechas(Reserva $reserva) 
    {
        return view('reserva.cambio_fechas',compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    /* */

    public function update_fechas(Request $request, Reserva $reserva) //Funcion que actualiza los datos de la reserva
    {
        $validatedData = $request->validate([
            'username' => ['required'],
            'nombre_reservante' => ['required'],
            'id' => ['required'],
            'cod_lab' => ['required'],
            'fecha_inicial' => ['required'],
            'fecha_final' => ['required'],
        ]);
        $total_bloque = $reserva->bloques;
        if($reserva->fecha_inicial > $validatedData['fecha_inicial']){//verificar
            $fechaini= $validatedData['fecha_inicial'];
            $fechafin = $reserva->fecha_inicial;
            $datos = $this->verificar($total_bloque,$fechaini,$fechafin,$reserva );
            if($datos){
                return back()->with(compact('datos')); 
            }; 
        }
        if($reserva->fecha_final < $validatedData['fecha_final']){//verificar
            $fechaini= $reserva->fecha_final;
            $fechafin = $validatedData['fecha_final'];
            $datos = $this->verificar($total_bloque,$fechaini,$fechafin,$reserva );
            if($datos){
                return back()->with(compact('datos')); 
            }; 
        }
        if($reserva->fecha_inicial > $validatedData['fecha_inicial']){//atrasar fecha inicio
            $fechaini= $validatedData['fecha_inicial'];
            $fechafin = $reserva->fecha_inicial;
            $this->guardar($fechaini,$fechafin,$total_bloque,$validatedData,$reserva );
        }
        if($reserva->fecha_final < $validatedData['fecha_final']){//avanzar fecha final
            $fechaini= $reserva->fecha_final;
            $fechafin = $validatedData['fecha_final'];
            $this->guardar($fechaini,$fechafin,$total_bloque,$validatedData,$reserva );
        }
        if($reserva->fecha_inicial < $validatedData['fecha_inicial']){//avanzar fecha inicial - borrar
            $eventos = evento::where('id_reserva',$reserva->id)
            ->whereDate('start','>=',$reserva->fecha_inicial)
            ->whereDate('start','<',$validatedData['fecha_inicial'])
            ->get();
            $eventos_array=$eventos->toArray();
            foreach ($eventos_array as $evento) {
                $id_evento = $evento['id'];
                evento::destroy($id_evento);
            }
        }
        if($reserva->fecha_final > $validatedData['fecha_final']){//atrasar fecha final - borrar
            $eventos = evento::where('id_reserva',$reserva->id)
            ->whereDate('start','>',$validatedData['fecha_final'])
            ->whereDate('start','<=',$reserva->fecha_final)
            ->get();
            $eventos_array=$eventos->toArray();
            foreach ($eventos_array as $evento) {
                $id_evento = $evento['id'];
                evento::destroy($id_evento);
            }
        }
        $reserva->fecha_inicial = $validatedData['fecha_inicial'];
        $reserva->fecha_final = $validatedData['fecha_final'];
        $reserva->save();
        $status = 'Has editado correctamente';
        return back()->with(compact('status'));
    }

    public function inactividad(Reserva $reserva) 
    {
        return view('reserva.inactividad',compact('reserva'));
    }

    public function inactividad_periodo(Request $request,Reserva $reserva) 
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'fecha_inicial' => ['required'],
            'fecha_final' => ['required'],
            'inicio_periodo' => ['required','after:'.$request['fecha_inicial'],'before:'.$request['fecha_final'],'before:'.$request['fin_periodo']],
            'fin_periodo' => ['required','after:'.$request['fecha_inicial'],'before:'.$request['fecha_final'],'after:'.$request['inicio_periodo']]
        ]);
        $eventos_reserva = evento::where('id_reserva','=',$validatedData['id'])
        ->whereDate('start','>=',$validatedData['inicio_periodo'])
        ->whereDate('start','<=',$validatedData['fin_periodo'])
        ->get();
        $eventos_array=$eventos_reserva->toArray();
        foreach ($eventos_array as $evento_ind) {
            $id_evento = $evento_ind['id'];
            evento::destroy($id_evento);
          }
        
        $status = 'Has dejado liberado el periodo correctamente';
        return back()->with(compact('reserva','status'));
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
        $reserva_ind = (Reserva::where('id','=',$id))->first();
        $usuario = (User::where('username','=',$reserva_ind->username)->first());
        if(((Auth::user()->tipo_usuario)==3)||((Auth::user()->username)==$reserva_ind->username)):
            $eventos_reserva = evento::where('id_reserva','=',$id)->get();
            $eventos_array=$eventos_reserva->toArray();
            foreach ($eventos_array as $evento_ind) {
                $id_evento = $evento_ind['id'];
                evento::destroy($id_evento);
            }
            Reserva::destroy($id);
            if((Auth::user()->tipo_usuario)==3){
                Mail::to($usuario->email)->queue(new NotificacionReservaEliminada($reserva_ind,$usuario)); //envia el mail
            }
            $status = 'Has eliminado la reserva completa correctamente';
            return back()->with(compact('status'));
        else:
            return redirect('reserva');
        endif;
    }
    public function eliminar_periodo(Reserva $reserva) 
    {
        return view('reserva.inactividad',compact('reserva'));
    }

    public function eliminar_periodo_destroy(Request $request,Reserva $reserva) 
    {
       
            $validatedData = $request->validate([
                'id' => ['required'],
                'fecha_inicial' => ['required'],
                'fecha_final' => ['required'],
                'inicio_periodo' => ['required','after:'.$request['fecha_inicial'],'before:'.$request['fecha_final'],'before:'.$request['fin_periodo']],
                'fin_periodo' => ['required','after:'.$request['fecha_inicial'],'before:'.$request['fecha_final'],'after:'.$request['inicio_periodo']]
            ]);

            $usuario = (User::where('username','=',$reserva->username))->first();
            $eventos_reserva = evento::where('id_reserva','=',$validatedData['id'])
            ->whereDate('start','>=',$validatedData['inicio_periodo'])
            ->whereDate('start','<=',$validatedData['fin_periodo'])
            ->get();
            $eventos_array=$eventos_reserva->toArray();
            foreach ($eventos_array as $evento_ind) {
                $id_evento = $evento_ind['id'];
                evento::destroy($id_evento);
            }
            if((Auth::user()->tipo_usuario)==3){
                Mail::to($usuario->email)->queue(new NotificacionPeriodoEliminado($validatedData,$reserva,$usuario));
            }
            $status = 'Has eliminado el periodo correctamente';
            return back()->with(compact('reserva','status'));

    }
}
