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
                                    <a href="{{ url('/reserva/'.$reserva->id.'/edit') }}" class="btn btn-primary">
                                        Editar reserva
                                    </a>
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