<script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>

<!-- fullcalendar bundle -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.js'></script>

<!-- the rrule-to-fullcalendar connector. must go AFTER the rrule lib -->
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.2.0/main.global.min.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialDate: '2020-05-12',
    editable: true,
    events: [
      {
        title: 'rrule event',
        rrule: {
          dtstart: '2020-10-01T13:00:00',
          freq: 'weekly'
        },
        duration: '02:00'
      }
    ],
    eventClick: function(arg) {
      if (confirm('delete event?')) {
        arg.event.remove()
      }
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