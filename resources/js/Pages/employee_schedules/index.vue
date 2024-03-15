<script setup>
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import InterActionPlugin from '@fullcalendar/interaction';

    const calendarOptions = {
        plugins: [dayGridPlugin, timeGridPlugin, InterActionPlugin],
        headerToolbar: {
          right: 'prev,next today',
          center: 'title',
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        lazyFetching: true,
        events: '/schedules/get-schedules',
    }



</script>

<template>
    <div >
        <FullCalendar :options="calendarOptions"/>
    </div>
</template>


