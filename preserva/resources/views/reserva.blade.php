@extends('layouts.app')

@section('content')
  

<div class="container">
    <div class="row justify-content-center">    
        <div class="col-md-8">
        
            <div class="card">
            
                <div class="card-header">{{ __('Tus Reservas') }} <form class="justify-content-around form-inline">
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
                        <a class=' btn-outline-info my-2 my-sm-0' href="{{ url('reserva') }}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                        </svg></a>
                </form></div>
                
                <div class="card-body">
                
                    
                    @foreach($reservas as $reserva)

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h2>Id: {{ $reserva->id }}</h2>
                                    <h4>Rut: {{ $reserva->username }}</h4>
                                    <h4>Reservado por: {{ $reserva->nombre_reservante }}</h4>
                                    <h4>Codigo Laboratorio: {{ $reserva->cod_lab }}</h4>
                                    <h4>Desde: {{ $reserva->fecha_inicial }}</h4>
                                    <h4>Hasta: {{ $reserva->fecha_final }}</h4>
                                    <h4>Dias: </h4>
                                    <h4>Bloques: </h4>
                                    <ul>
                                        @foreach ($reserva->bloques as $bloque_ind)
                                            <li>{{ $bloque_ind }} </li>
                                        @endforeach
                                    </ul>
                                    <h4>Capacidad: {{ $reserva->cap_res }}</h4>
                                    
                                    <form action = "{{ url('/reserva/'.$reserva->id.'/edit') }}">
                                        <button class="button button2 " type = "submit" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                        </svg> Editar reserva </button>
                                        
                                    </form>
                                    <form action = "{{ url('/reserva/'.$reserva->id.'/inactividad') }}">
                                        <button class="button button2 " type = "submit" ><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
                                        </svg> Liberar periodo </button>
                                        
                                    </form>
                                    @if((auth::user()->tipo_usuario)==3)
                                        <form method ='POST' action = "{{ url('/reserva/'.$reserva->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <form method ='POST' action = "{{ url('/reserva/'.$reserva->id) }}">
                                            <button class="button button3" type = "submit" onclick="return confirm('Confirmar borrado')"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                            </svg> Borrar reserva </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        
                    @endforeach
                    {{ $reservas->appends(['buscar_lab'=>request('buscar_lab'),'fecha_buscar'=>request('fecha_buscar')])->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection