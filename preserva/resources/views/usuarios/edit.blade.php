@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar usuario ') }} {{ $usuario->name }} {{ $usuario->apellido }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('usuarios/'.$usuario->id) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Nombre') }}</label>
                            <input id="name" value ="{{ $usuario->name }}" type="text" class="form-control "   name="name"  required autocomplete="name" autofocus>

                            
                        </div>

                        <div class="form-group">
                            <label for="apellido">{{ __('Apellido') }}</label>
                            <input id="apellido" value ="{{ $usuario->apellido }}" type="text" class="form-control "   name="apellido"  required autocomplete="apellido" autofocus>

                            
                        </div>

                        <div class="form-group">
                            <label for="tipo_usuario">{{ __('Tipo de usuario') }}</label>
                        
                            <select name="tipo_usuario" class="form-control" >
                                    <option value="1">Alumno/a</option>
                                    <option value="2">Ayudante</option> 
                                    <option value="3">Encargado/a de laboratorio</option> 
                                    <option value="4">Profesor/a<</option> 
                                    <option value="5">Secretario/a</option> 
                                </select>

                        </div>
                        <div class="form-group">
                            <label for="estado">{{ __('Estado') }}</label>
                        
                            <select name="estado" class="form-control" >
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option> 
                                </select>

                        </div>
                        <div class="form-group">
                            <label for="ciudad" >{{ __('Ciudad') }}</label>

                            <select name="ciudad" class="form-control">
                                    <option value="1">Talca</option> 
                                    <option value="2">Constitucion</option>
                                    <option value="3">Curico</option>
                                    <option value="4">San Clemente</option>
                                    <option value="5">Rancagua</option>
                                    <option value="6">Santiago</option>   
                                </select>
                        </div>


                                <button type="submit" class="button button1">
                                    {{ __('Guardar') }}
                                </button>
                                
                                
                    </form>
                                <form action = "{{ url('/usuarios') }}">
                                        <button class="button button4" type = "submit" >Volver </button>
                                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
