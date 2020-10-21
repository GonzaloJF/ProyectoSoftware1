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

                    
                    <form method="POST" action="{{ url('reserva/'.$reserva->id) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('RUT') }}</label>
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
                            <input id="fecha_inicial" value ="{{ $reserva->fecha_inicial }}" type="date" class="form-control @error('fecha_inicial') is-invalid @enderror" readonly=»readonly» name="fecha_inicial"  required autocomplete="fecha_inicial" autofocus>

                            @error('fecha_inicial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="fecha_final">{{ __('Fecha final') }}</label>
                            <input id="fecha_final" value ="{{ $reserva->fecha_final }}" type="date" class="form-control @error('fecha_final') is-invalid @enderror"  readonly=»readonly» name="fecha_final"  required autocomplete="fecha_final" autofocus>

                            @error('fecha_final')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                        <label for="bloques">{{ __('Bloques') }}</label>
                        @foreach ($reserva->bloques as $bloque_ind)
                            <li>{{ $bloque_ind }} </li>
                        @endforeach
                        </div>

                        <div class="form-group">
                            <label for="inicio_periodo">{{ __('Inicio periodo inactividad') }}</label>
                            <input id="inicio_periodo"  type="date" class="form-control @error('inicio_periodo') is-invalid @enderror"   name="inicio_periodo"  required autocomplete="inicio_periodo" autofocus>

                            @error('inicio_periodo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        
                        <div class="form-group">
                            <label for="fin_periodo">{{ __('Fin periodo inactividad') }}</label>
                            <input id="fin_periodo" value ="{{ $reserva->fecha }}" type="date" class="form-control @error('fin_periodo') is-invalid @enderror"  name="fin_periodo"  required autocomplete="fin_periodo" autofocus>

                            @error('fin_periodo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

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
