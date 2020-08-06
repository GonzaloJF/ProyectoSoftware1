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

                    
                    <form method="POST" action="{{ url('reserva') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="codigo_de_laboratorio">{{ __('Codigo Laboratorio') }}</label>
                            <input id="codigo_de_laboratorio" type="text" class="form-control @error('codigo_de_laboratorio') is-invalid @enderror" name="codigo_de_laboratorio" value="{{ old('codigo_de_laboratorio') }}" required autocomplete="codigo_de_laboratorio" autofocus>

                            @error('codigo_de_laboratorio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        
                        <div class="form-group">
                            <label for="capacidad">{{ __('Capacidad del Laboratorio') }}</label>
                            <input id="capacidad" type="integer" class="form-control @error('capacidad') is-invalid @enderror" name="capacidad" value="{{ old('capacidad') }}" required autocomplete="capacidad" autofocus>

                            @error('capacidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="facultad">{{ __('Facultad') }}</label>
                        
                            <select name="facultad" >
                                    <option value="medicina">medicina</option>
                                    <option value="ciencias basicas">ciencias basicas</option> 
                                    <option value="ingenieria">ingenieria</option> 
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="Tipo_laboratorio">{{ __('Facultad') }}</label>
                        
                            <select name="Tipo_laboratorio" >
                                    <option value="Computacion">Computacion</option>
                                    <option value="Quimica">Quimica</option> 
                                    <option value="Anatomia">Anatomia</option> 
                                    <option value="Fisica">Fisica</option> 
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
