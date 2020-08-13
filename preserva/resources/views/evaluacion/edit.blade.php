@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evaluacion') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('evaluacion/'.$solicitud->id) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ __('RUT') }}</label>
                            <input id="username" value ="{{ $solicitud->username }}" type="text" class="form-control "  readonly=»readonly» name="username"  required autocomplete="username" autofocus>

                            
                        </div>

                        <div class="form-group">
                            <label for="nombre_completo">{{ __('Nombre') }}</label>
                            <input id="nombre_completo" value ="{{ $solicitud->nombre_completo }}" type="text" class="form-control "  readonly=»readonly» name="nombre_completo"  required autocomplete="nombre_completo" autofocus>

                            
                        </div>
                        
                        <div class="form-group">
                            <label for="cod_lab">{{ __('Codigo Laboratorio') }}</label>
                            <input id="cod_lab" value ="{{ $solicitud->cod_lab }}" type="text" class="form-control "  readonly=»readonly» name="cod_lab"  required autocomplete="cod_lab" autofocus>
   
                        </div>
                        
                        <div class="form-group">
                            <label for="fecha">{{ __('fecha') }}</label>
                            <input id="fecha" value ="{{ $solicitud->fecha }}" type="text" class="form-control "  readonly=»readonly» name="fecha"  required autocomplete="fecha" autofocus>
   
                        </div>

                        <div class="form-group">
                            <label for="bloque">{{ __('bloque') }}</label>
                            <input id="bloque" value ="{{ $solicitud->bloque }}" type="text" class="form-control "  readonly=»readonly» name="bloque"  required autocomplete="bloque" autofocus>
   
                        </div>

                        <div class="form-group">
                            <label for="cap_sol">{{ __('Capacidad a solicitar') }}</label>
                            <input id="cap_sol" value ="{{ $solicitud->cap_sol }}" type="text" class="form-control "  readonly=»readonly» name="cap_sol"  required autocomplete="cap_sol" autofocus>
   
                        </div>
                        @if(( $solicitud->estado )=="En espera")
                            <div class="form-group">
                                <label for="estado">{{ __('Estado') }}</label>
                            
                                <select name="estado" class="form-control" >
                                        <option value="Rechazada">Rechazada</option>
                                        <option value="Aceptada">Aceptada</option>  
                                    </select>
                            </div>
                        

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                        
                            </form>
                        </form>
                        @else
                        </form>
                                <form action = "{{ url('/evaluacion') }}">
                                        <button class="button button4" type = "submit" >Volver </button>
                                </form>
                        @endif

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
