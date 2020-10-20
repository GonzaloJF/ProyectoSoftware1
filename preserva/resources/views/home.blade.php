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
          businessHours: true,


          events: "{{ route('show') }}"
          /*events: [
            {id : 10,
              cod_lab: 'dci_2',
              title: 'rrule event',
        //rrule: {byweekday: [ 'mo' ],dtstart: '2020-10-01T13:00:00',until: '2020-11-09T13:00:00',freq: 'weekly'}
        rrule: 'DTSTART:2020-10-01\nRRULE:FREQ=WEEKLY;UNTIL=2020-11-09;BYWEEKDAY=FR'
            // 'DTSTART:2020-10-15\nRRULE:FREQ=WEEKLY;UNTIL=2020-11-21;BYWEEKDAY=FR'
                
      },

      ]*/
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
