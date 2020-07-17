@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tus solicitudes') }}</div>

                <div class="card-body">
                    
                    @foreach($solicitudes as $solicitud)

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h2>Id: {{ $solicitud->id }}</h2>
                                    <h4>Rut: {{ $solicitud->username }}</h4>
                                    <h4>Nombre: {{ $solicitud->nombre_completo }}</h4>
                                    <h4>Fecha: {{ $solicitud->fecha }}</h4>
                                    <h4>Bloque: {{ $solicitud->bloque }}</h4>
                                    <h4>Capacidad: {{ $solicitud->cap_sol }}</h4>
                                    <h4>Estado: {{ $solicitud->estado }}</h4>
                                </div>
                            </div>
                        
                    @endforeach
                    {{ $solicitudes->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection