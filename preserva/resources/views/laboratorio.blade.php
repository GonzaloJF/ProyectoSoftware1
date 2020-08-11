@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('Laboratorios') }}</div>
                
                <div class="card-body">
                
                    
                    @foreach($laboratorios as $laboratorio)

                            <div class="card mt-2">
                                <div class="card-header">
                                    <h4>Codigo Laboratorio: {{ $laboratorio->Codigo_de_laboratorio }}</h4>
                                    <h4>Capacidad: {{ $laboratorio->Capacidad }}</h4>
                                    <h4>Facultad: {{ $laboratorio->Facultad }}</h4>
                                    <h4>Tipo laboratorio: {{ $laboratorio->Tipo_laboratorio }}</h4>
                                   
     
                                </div>
                            </div>
                            @guest 
                            @else   
                                @if((auth::user()->tipo_usuario)==10)
                                    <form action = "{{ url('/laboratorio/'.$laboratorio->id.'/edit') }}">
                                        <button class="button button2" type = "submit" >Editar Laboratorio </button>
                                    </form>                                
                                    @endif

                            
                            @endguest
                        
                    @endforeach
                    {{ $laboratorios->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection