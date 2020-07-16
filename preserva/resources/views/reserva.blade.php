@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ultimas Reservas') }}</div>

                <div class="card-body">
                    
                    @foreach($reservas as $reserva)
                        @if((auth::user()->username)==$reserva->username)
                            <h4>Rut: {{ $reserva->username }}</h4>
                            <h4>Nombre: {{ $reserva->nombre_completo }}</h4>
                            <h4>Fecha: {{ $reserva->fecha }}</h4>
                            <h4>Bloque: {{ $reserva->bloque }}</h4>
                            <h4>Capacidad: {{ $reserva->cap_res }}</h4>
                            <h4>____________________________________ </h4>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection