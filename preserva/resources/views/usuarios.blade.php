@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('Usuarios') }}</div>
                
                <div class="card-body">
                
                    
                    @foreach($usuarios as $usuario)

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h4>Rut: {{ $usuario->username }}</h4>
                                    <h4>Nombre: {{ $usuario->name }}</h4>
                                    <h4>Apellido: {{ $usuario->apellido }}</h4>
                                    <h4>Correo: {{ $usuario->email }}</h4>
                                    <h4>Tipo: {{ $usuario->tipo_usuario }}</h4>
                                    <h4>Estado: {{ $usuario->estado }}</h4>
                                    <h4>Ciudad: {{ $usuario->ciudad }}</h4>
                                    
                                    
                            
                                </div>
                            </div>
                        
                    @endforeach
                    {{ $usuarios->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection