@extends('layouts.app')

@section('content')

<div class="bg-white text-black p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold mb-4">Calendar</h2>

    <div id="calendar"></div>

</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,

        events: '/calendar/events',

        eventClick: function(info) {
            alert(
                "Task: " + info.event.title + "\n" +
                "Date: " + info.event.start.toISOString().split('T')[0]
            );
        }
    });

    calendar.render();

});
</script>

@endsection