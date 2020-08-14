@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nuevo Laboratorio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('laboratorio/create') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="Codigo_de_laboratorio">{{ __('Codigo Laboratorio') }}</label>
                            <input id="Codigo_de_laboratorio" type="text" class="form-control @error('Codigo_de_laboratorio') is-invalid @enderror" name="Codigo_de_laboratorio" value="{{ old('Codigo_de_laboratorio') }}" required autocomplete="Codigo_de_laboratorio" autofocus>

                            @error('Codigo_de_laboratorio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        
                        <div class="form-group">
                            <label for="Capacidad">{{ __('Capacidad del Laboratorio') }}</label>
                            <input id="Capacidad" type="integer" class="form-control @error('Capacidad') is-invalid @enderror" name="Capacidad" value="{{ old('Capacidad') }}" required autocomplete="Capacidad" autofocus>

                            @error('Capacidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="Facultad">{{ __('Facultad') }}</label>
                        
                            <select name="Facultad" class="form-control">
                                    <option value="Medicina">Medicina</option>
                                    <option value="Ciencias basicas">Ciencias basicas</option> 
                                    <option value="Ingenieria">Ingenieria</option>
                                    <option value="Psicologia">Psicologia</option> 
                                    <option value="Derecho">Derecho</option>
                                    <option value="Ciencias de la salud">Ciencias de la salud</option>
                                    <option value="Ciencias agrarias">Ciencias agrarias</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="Tipo_laboratorio">{{ __('Tipo de laboratorio') }}</label>
                        
                            <select name="Tipo_laboratorio" class="form-control" >
                                    <option value="Computacion">Computacion</option>
                                    <option value="Quimica">Quimica</option> 
                                    <option value="Anatomia">Anatomia</option> 
                                    <option value="Fisica">Fisica</option>
                                    <option value="Suelos">Suelos</option>
                                    <option value="Clinico">Clinico</option>
                                    <option value="Biologia">Biologia</option>
                                </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Laboratorio') }}
                                </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
