@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('Tus Reservas') }}</div>
                
                <div class="card-body">
                
                    
                    @foreach($reservas as $reserva)

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h2>Id: {{ $reserva->id }}</h2>
                                    <h4>Rut: {{ $reserva->username }}</h4>
                                    <h4>Nombre: {{ $reserva->nombre_completo }}</h4>
                                    <h4>Codigo Laboratorio: {{ $reserva->cod_lab }}</h4>
                                    <h4>Fecha: {{ $reserva->fecha }}</h4>
                                    <h4>Bloque: {{ $reserva->bloque }}</h4>
                                    <h4>Capacidad: {{ $reserva->cap_res }}</h4>
                                    
                                    <form action = "{{ url('/reserva/'.$reserva->id.'/edit') }}">
                                        <button class="button button2" type = "submit" >Editar reserva </button>
                                    </form>
                                    @if((auth::user()->tipo_usuario)==3)
                                        <form method ='POST' action = "{{ url('/reserva/'.$reserva->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        
                                            <button class="button button3" type = "submit" onclick="return confirmar()">Borrar reserva </button>

                                            <script>
                                            function confirmar() {
                                            confirm("Confirmar borrado");
                                            }
                                            </script>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        
                    @endforeach
                    {{ $reservas->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection