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
                                    @if($usuario->tipo_usuario==1)
                                        <h4>Tipo: Alumno/a</h4>
                                    @endif
                                    @if($usuario->tipo_usuario==2)
                                        <h4>Tipo: Ayudante</h4>
                                    @endif
                                    @if($usuario->tipo_usuario==3)
                                        <h4>Tipo: Encargado/a de laboratorio</h4>
                                    @endif
                                    @if($usuario->tipo_usuario==4)
                                        <h4>Tipo: Profesor/a</h4>
                                    @endif
                                    @if($usuario->tipo_usuario==5)
                                        <h4>Tipo: Secretario/a</h4>
                                    @endif
                                    @if($usuario->estado==1)
                                        <h4>Estado: Activo</h4>
                                    @endif
                                    @if($usuario->tipo_usuario==10)
                                        <h4>Tipo: ADMIN</h4>
                                    @endif
                                    @if($usuario->estado==2)
                                        <h4>Estado: Inactivo</h4>
                                    @endif
                                    
                                    
                                    
                            
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