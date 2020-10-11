@extends('layouts.app')

@section('content')
<link href='{{ asset('assets/lib/main.css') }}' rel='stylesheet' />
    <script src='{{ asset('assets/lib/main.js') }}'></script>
    <script src={{ asset('assets/lib/locales/es.js') }}></script>
    <script>
    
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
          locale: 'es',
          editable: true,
          selectable: true,
          businessHours: true,
          dayMaxEvents: true, // allow "more" link when too many events
          events: [
        
          ]
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
        max-width: 1100px;
        margin: 0 auto;
      }
    
    </style>
<div class="container">
    
        <div    >
            <div class="card">

                <div id='calendar'></div>
                    
            </div>
        </div>
    
</div>
@endsection
