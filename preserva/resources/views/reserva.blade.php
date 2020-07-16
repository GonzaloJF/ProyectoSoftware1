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
                            <p>Rut: {{ $reserva->username }}</p>
                            <p>Nombre: {{ $reserva->nombre_completo }}</p>
                            <p>Fecha: {{ $reserva->fecha }}</p>
                            <p>Bloque: {{ $reserva->bloque }}</p>
                            <p>Capacidad: {{ $reserva->cap_res }}</p>
                            <p>____________________________________ </p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection