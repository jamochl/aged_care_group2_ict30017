<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{ // this object will be "parsed" into an Event Object
                    title: 'The Title', // a property!
                    start: '2018-09-01', // a property!
                    end: '2025-09-02' // a property! ** see important note below about 'end' **
                }]
            });
            calendar.render();
        });
    </script>
</head>

<body>
    <div id='calendar'></div>
</body>

</html>