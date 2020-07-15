@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva Reserva') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('reserva') }}">
                        @csrf

                        <div class="form-group">
                            <input id="username" value ="{{ (auth::user()->username) }}" type="text" class="form-control "  readonly=»readonly» name="username"  required autocomplete="usernames" autofocus>

                            
                        </div>
                        
                        <div class="form-group">
                            <label for="cod_lab">{{ __('Codigo Laboratorio') }}</label>
                            <input id="cod_lab" type="text" class="form-control @error('cod_lab') is-invalid @enderror" name="cod_lab" value="{{ old('cod_lab') }}" required autocomplete="cod_lab" autofocus>

                            @error('cod_lab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        
                        <div class="form-group">
                            <label for="fecha">{{ __('fecha') }}</label>
                            <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha" autofocus>

                            @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="bloque">{{ __('Bloque') }}</label>
                        
                            <select name="bloque" >
                                    <option value="1">1</option>
                                    <option value="2">2</option> 
                                    <option value="3">3</option> 
                                    <option value="4">4</option> 
                                    <option value="5">5</option> 
                                    <option value="6">6</option> 
                                    <option value="7">8</option> 
                                    <option value="9">9</option>
                                    <option value="10">10</option> 
                                    <option value="11">11</option> 
                                    <option value="12">12</option>  
                                </select>

                        </div>


                        <div class="form-group">
                            <label for="cap_res">{{ __('Capacidad a reservar') }}</label>
                            <input id="cap_res" type="integer" class="form-control @error('cap_res') is-invalid @enderror" name="cap_res" value="{{ old('cap_res') }}" required autocomplete="cap_res" autofocus>

                            @error('cap_res')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reservar') }}
                                </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
