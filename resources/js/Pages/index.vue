<script setup>
</script>
<template>
    <div style="height: inherit;">
        <FullCalendar :options="calendarOptions" :select="handleSelect" />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import InterActionPlugin from '@fullcalendar/interaction';

export default defineComponent({
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, InterActionPlugin, timeGridPlugin],
        headerToolbar: {
          right: 'prev,next today',
          center: 'title',
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: [
          {
            title: 'Event 1',
            start: '2024-03-03',
            end: '2024-03-03',
          },
          {
            title: 'Event 2',
            start: '2024-01-05',
            end: '2024-01-07',
          },
        ],
        allDay: false,
        eventClick: (arg) => {
          console.log(arg)
        },
        select: (info) => {
          console.log(info)
        },
        eventDrop: () => {
          alert("HAHAHAHA")
        },
        eventResize: (arg) => {
          ar
        }
       
      },
    };
  },
  methods: {
    handleSelect(arg) {
      console.log("TEST")
      console.log(arg)
    }
  }
});
</script>
