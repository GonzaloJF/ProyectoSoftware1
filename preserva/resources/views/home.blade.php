@extends('layouts.app')

@section('content')

<link href='{{ asset('assets/lib/main.css') }}' rel='stylesheet' />
    
    <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
    <script src='{{ asset('assets/lib/main.js') }}'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.2.0/main.global.min.js'></script>
    <script src={{ asset('assets/lib/locales/es.js') }}></script>
    <script>
    
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'es',
          dayMaxEvents: true,
          businessHours: true,
          events: {!! json_encode($eventos) !!}, //arreglo con datos de eventos en formato para fullcalendar
          
        eventClick: function(info) {
        //alert(info.event.title);
        info.jsEvent.preventDefault();
        window.open(info.event.url);
         // change the border color just for fun
          //info.el.style.borderColor = 'red';
       }
    });
        calendar.render();
      });
          
    </script>
    <style>
    
      body {
        margin: 40px 10px;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
      }
    
      #calendar {
        max-width: 0 auto;
        margin: 0 auto;
      }
      
    
    </style>
<div class="container">
      
        <div    >
            <form class = "card" action=" {{ route('home') }} " method="GET">
              <div class="justify-content-around form-inline"> 
                <label class="form"> CODIGO DE LABORATORIO:</label>
                  <select name ="buscar_lab">
                    <option value= "Todos">-- Todos --</option>
                    @foreach($laboratorios as $laboratorio)
                        <option value="{{ $laboratorio->Codigo_de_laboratorio  }}">{{ $laboratorio->Codigo_de_laboratorio  }}</option>
                    @endforeach
                    
                  </select>
                  <button class="btn btn-outline-info " href="{{ url('home') }}" type="submit">Buscar</button>
                
              </div>
            </form>
            <div class="card">
              
                <div id='calendar'></div>
                    
            </div>
        </div>
    
</div>
@endsection
