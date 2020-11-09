@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva Reserva') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('datos'))
                        <div class="alert alert-danger" role="alert">
                             Hay bloques reservados:
                            <ul>
                            @foreach (session('datos') as $dato)
                                <li> {{ $dato['dia_bloque'] }} {{ ' ' }} {{ $dato['fecha']->format('Y-M-d') }}</li>
                            @endforeach
                            </ul>
                            
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('reserva') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('RUT') }}</label>
                            <input id="username" value ="{{ (auth::user()->username) }}" type="text" class="form-control "  readonly=»readonly» name="username"  required autocomplete="username" autofocus>

                            
                        </div>

                        <div class="form-group">
                            <label for="nombre_reservante">{{ __('Nombre') }}</label>
                            <input id="nombre_reservante" value ="{{ (auth::user()->name) }}{{ (' ') }}{{ (auth::user()->apellido) }}" type="text" class="form-control "  readonly=»readonly» name="nombre_reservante"  required autocomplete="nombre_reservante" autofocus>
                        </div>

                        
                        <div class="form-group">
                            <label for="cod_lab">{{ __('Codigo Laboratorio') }}</label>
                        
                            <select name="cod_lab"class="form-control" >
                                @foreach($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->Codigo_de_laboratorio  }}">{{ $laboratorio->Codigo_de_laboratorio  }}: Capacidad: {{ $laboratorio->Capacidad }}, Facultad: {{ $laboratorio->Facultad }}, Tipo: {{ $laboratorio->Tipo_laboratorio }}</option>
                                @endforeach
                                
                                </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="fecha_inicial">{{ __('fecha_inicial') }}</label>
                            <input id="fecha_inicial" type="date" class="form-control @error('fecha_inicial') is-invalid @enderror" name="fecha_inicial" value="{{ old('fecha_inicial') }}" required autocomplete="fecha_inicial" autofocus>

                            @error('fecha_inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="fecha_final">{{ __('fecha_final') }}</label>
                            <input id="fecha_final" type="date" class="form-control @error('fecha_final') is-invalid @enderror" name="fecha_final" value="{{ old('fecha_final') }}" required autocomplete="fecha_final" autofocus>

                            @error('fecha_final')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Lunes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="lunes1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 class="panel-title">
                                        Martes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="martes1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="martes2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="martes3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="martes4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="martes5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="martes6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="martes7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="martes8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="martes9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="martes10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="martes11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="martes12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 class="panel-title">
                                        Miercoles
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="miercoles1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 class="panel-title">
                                        Jueves
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="jueves1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 class="panel-title">
                                        Viernes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="viernes1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 class="panel-title">
                                        Sabado
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>BLOQUES: </label>
                                        <br>
                                        <input type="checkbox" name="bloques[]" value ="sabado1"> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado2"> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado3"> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado4"> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado5"> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado6"> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado7"> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado8"> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado9"> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado10"> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado11"> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado12"> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="atomica">{{ __('Atomica') }}</label>
                        
                            <select name="atomica"class="form-control" >
                                <option value="no">no</option>
                                <option value="si">si</option>  
                            </select>
                        </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reservar') }}
                                </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
