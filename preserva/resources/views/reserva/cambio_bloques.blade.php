@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Reserva ') }}{{ __($reserva->id) }}</div>

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

                    
                    <form method="POST" action="{{ url('reserva/'.$reserva->id.'/update_fechas') }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('Rut') }}</label>
                            <input id="username" value ="{{ $reserva->username }}" type="text" class="form-control "  readonly=»readonly» name="username"  required autocomplete="username" autofocus>
                            
                        </div>

                        <div class="form-group">
                            <label for="nombre_reservante">{{ __('Nombre') }}</label>
                            <input id="nombre_reservante" value ="{{ $reserva->nombre_reservante }}" type="text" class="form-control "  readonly=»readonly» name="nombre_reservante"  required autocomplete="nombre_reservante" autofocus>
                            
                        </div>

                        <div class="form-group">
                            <label for="id">{{ __('Id reserva') }}</label>
                            <input id="id" value ="{{ $reserva->id }}" type="integer" class="form-control @error('id') is-invalid @enderror" readonly=»readonly»  name="id"  required autocomplete="id" autofocus>
                            
                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="cod_lab">{{ __('Codigo Laboratorio') }}</label>
                            <input id="cod_lab" value ="{{ $reserva->cod_lab }}" type="text" class="form-control @error('cod_lab') is-invalid @enderror" readonly=»readonly»  name="cod_lab"  required autocomplete="cod_lab" autofocus>
                            
                            @error('cod_lab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="fecha_inicial">{{ __('Fecha inicial') }}</label>
                            <input id="fecha_inicial" value ="{{ $reserva->fecha_inicial }}" type="date" class="form-control @error('fecha_inicial') is-invalid @enderror" readonly=»readonly»  name="fecha_inicial"  required autocomplete="fecha_inicial" autofocus>
                            @error('fecha_inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="fecha_final">{{ __('Fecha final') }}</label>
                            <input id="fecha_final" value ="{{ $reserva->fecha_final }}" type="date" class="form-control @error('fecha_final') is-invalid @enderror" readonly=»readonly»  name="fecha_final"  required autocomplete="fecha_final" autofocus>

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
                                        <input type="checkbox" name="bloques[]" value ="lunes1" @if(in_array("lunes1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes2"@if(in_array("lunes2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes3"@if(in_array("lunes3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes4"@if(in_array("lunes4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes5"@if(in_array("lunes5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes6"@if(in_array("lunes6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes7"@if(in_array("lunes7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes8"@if(in_array("lunes8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes9"@if(in_array("lunes9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes10"@if(in_array("lunes10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes11"@if(in_array("lunes11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="lunes12"@if(in_array("lunes12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
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
                                        <input type="checkbox" name="bloques[]" value ="martes1" @if(in_array("martes1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="martes2"@if(in_array("martes2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="martes3"@if(in_array("martes3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="martes4"@if(in_array("martes4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="martes5"@if(in_array("martes5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="martes6"@if(in_array("martes6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="martes7"@if(in_array("martes7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="martes8"@if(in_array("martes8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="martes9"@if(in_array("martes9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="martes10"@if(in_array("martes10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="martes11"@if(in_array("martes11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="martes12"@if(in_array("martes12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
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
                                        <input type="checkbox" name="bloques[]" value ="miercoles1" @if(in_array("miercoles1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles2"@if(in_array("miercoles2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles3"@if(in_array("miercoles3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles4"@if(in_array("miercoles4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles5"@if(in_array("miercoles5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles6"@if(in_array("miercoles6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles7"@if(in_array("miercoles7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles8"@if(in_array("miercoles8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles9"@if(in_array("miercoles9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles10"@if(in_array("miercoles10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles11"@if(in_array("miercoles11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="miercoles12"@if(in_array("miercoles12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
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
                                        <input type="checkbox" name="bloques[]" value ="jueves1" @if(in_array("jueves1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves2"@if(in_array("jueves2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves3"@if(in_array("jueves3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves4"@if(in_array("jueves4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves5"@if(in_array("jueves5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves6"@if(in_array("jueves6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves7"@if(in_array("jueves7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves8"@if(in_array("jueves8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves9"@if(in_array("jueves9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves10"@if(in_array("jueves10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves11"@if(in_array("jueves11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="jueves12"@if(in_array("jueves12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
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
                                        <input type="checkbox" name="bloques[]" value ="viernes1" @if(in_array("viernes1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes2"@if(in_array("viernes2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes3"@if(in_array("viernes3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes4"@if(in_array("viernes4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes5"@if(in_array("viernes5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes6"@if(in_array("viernes6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes7"@if(in_array("viernes7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes8"@if(in_array("viernes8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes9"@if(in_array("viernes9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes10"@if(in_array("viernes10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes11"@if(in_array("viernes11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="viernes12"@if(in_array("viernes12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
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
                                        <input type="checkbox" name="bloques[]" value ="sabado1" @if(in_array("sabado1", $reserva->bloques)) checked @endif> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado2"@if(in_array("sabado2", $reserva->bloques)) checked @endif> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado3"@if(in_array("sabado3", $reserva->bloques)) checked @endif> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado4"@if(in_array("sabado4", $reserva->bloques)) checked @endif> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado5"@if(in_array("sabado5", $reserva->bloques)) checked @endif> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado6"@if(in_array("sabado6", $reserva->bloques)) checked @endif> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado7"@if(in_array("sabado7", $reserva->bloques)) checked @endif> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado8"@if(in_array("sabado8", $reserva->bloques)) checked @endif> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado9"@if(in_array("sabado9", $reserva->bloques)) checked @endif> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado10"@if(in_array("sabado10", $reserva->bloques)) checked @endif> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado11"@if(in_array("sabado11", $reserva->bloques)) checked @endif> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="bloques[]" value ="sabado12"@if(in_array("sabado12", $reserva->bloques)) checked @endif> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar') }}
                            </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
