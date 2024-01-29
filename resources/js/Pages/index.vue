<script setup>
</script>
<template>
    <div style="height: inherit;">
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

export default defineComponent({
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin],
        headerToolbar: {
          right: 'prev,next today',
          center: 'title',
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        initialView: 'dayGridWeek',
        events: [
          {
            title: 'Event 1',
            start: '2024-01-01',
            end: '2024-01-03',
          },
          {
            title: 'Event 2',
            start: '2024-01-05',
            end: '2024-01-07',
          },
          // Add more events as needed
        ],
      },
    };
  },
});
</script>
