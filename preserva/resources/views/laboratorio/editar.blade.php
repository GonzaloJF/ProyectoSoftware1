@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar laboratorio ') }}{{ __($laboratorio->id) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('reserva/'.$reserva->id) }}">
                        @method('PATCH')
                        @csrf

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
                        
                            <select name="Facultad" >
                                    <option value="medicina">medicina</option>
                                    <option value="ciencias basicas">ciencias basicas</option> 
                                    <option value="ingenieria">ingenieria</option> 
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="Tipo_laboratorio">{{ __('Tipo de laboratorio') }}</label>
                        
                            <select name="Tipo_laboratorio" >
                                    <option value="Computacion">Computacion</option>
                                    <option value="Quimica">Quimica</option> 
                                    <option value="Anatomia">Anatomia</option> 
                                    <option value="Fisica">Fisica</option> 
                                </select>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection