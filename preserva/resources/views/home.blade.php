@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div    >
            <div class="card">

                <div class="card-body"><form class="justify-content-around form-inline">
                         <label class="form">{{ __('Codigo Laboratorio:') }}</label>
                         <p>  &nbsp  </p> 
                            <select name="buscar_lab" class="form-control">
                                <option>Todos</option>
                                @foreach($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->Codigo_de_laboratorio  }}">{{ $laboratorio->Codigo_de_laboratorio  }}</option>
                                @endforeach
                                
                            </select>
                            <p>  &nbsp  </p>
                            <label class="form">{{ __('Fecha:') }}</label>
                            <p>  &nbsp  </p>
                            <input id="fecha_buscar" type="date" class="form-control" name="fecha_buscar" value="{{ old('fecha_buscar') }}" autocomplete="fecha_buscar" autofocus>
                            <p>  &nbsp  </p>
                         <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Buscar</button>
                        <p>  &nbsp  </p> 
                        <a class=' btn-outline-info my-2 my-sm-0' href="{{ url('home') }}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                        </svg></a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    

                </div>
                    
                        <div class="list-group">
                       
                        <div class="row">    
                        @foreach($reservas as $reserva)
                            <div class="col-sm-5 col-md-6">
                                <li class="list-group-item active">
                                    <li class="list-group-item reserva text-center ">
                                        <h4 class="red"><strong>Laboratorio: {{ $reserva->cod_lab }}</strong></h4>
                                        <h4><strong>Solicitado por: {{ $reserva->nombre_reservante }}</ls></h4>
                                        <h4><stron>Fecha: {{ $reserva->fecha }}</strong></h4>
                                        <h4><strong>Solicitado por: Bloque: {{ $reserva->bloque }}</strong></h4>
                                    </li>
                                </li>
                            </div>
                        
                        @endforeach
                        </div>
                        {{ $reservas->appends(['buscar_lab'=>request('buscar_lab'),'fecha_buscar'=>request('fecha_buscar')])->links() }}
                        
                        </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
