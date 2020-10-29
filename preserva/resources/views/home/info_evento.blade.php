@extends('layouts.app')

@section('content')
  

<div class="container">
    <div class="row justify-content-center">    
        <div class="col-md-8">
        
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

               
                <div class="card-body ">
                    <h1 class="text-center"><strong>Reserva</strong></h1>
                    <h2><dl>
                        <div class="row">
                            <dt class= "col">Dia:</dt>
                            <dd class= "col">{{ $evento['start']}}</dd>
                        </div>
                        <div class="row">
                            <dt class= "col">Codigo de laboratorio:</dt>
                            <dd class= "col">{{ $evento['cod_lab']}}</dd>
                        </div>
                        <div class="row">
                            <dt class= "col">Bloque: </dt>
                            @php $evento['title'] = str_replace('Bloque',' ',$evento['title']) @endphp
                            <dd class= "col">{{ $evento['title'] }}</dd>
                        </div>
                        <div class="row">
                            <dt class= "col">Reservado por:</dt>
                            <dd class= "col">{{ $usuario['name'] }} {{ $usuario['apellido'] }}</dd>
                        </div>
                        <div class="row">
                            <dt class= "col">Desde:</dt>
                            <dd class= "col">{{ $reserva['fecha_inicial']}}</dd>
                        </div>
                        <div class="row">
                            <dt class= "col">Hasta:</dt>
                            <dd class= "col">{{ $reserva['fecha_final']}}</dd>
                        </div>
                      </dl> 
                    </h2>
                </div>
                <a class = "text-center" href="{{ url('/home') }}"><button class="button button2" >Volver al inicio</button></a>
            </div>
        </div>
    </div>
</div>
@endsection