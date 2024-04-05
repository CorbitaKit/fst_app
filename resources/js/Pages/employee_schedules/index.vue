<script setup>
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import InterActionPlugin from '@fullcalendar/interaction';
    import { ref } from 'vue';
    import axios from 'axios'

    const event = ref()
    const view = ref()

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
        eventClick: (arg) => {
           axios.get('/schedules/' + arg.event.id)
           .then(response => {
            event.value = response.data
            view.value = true
           })
        },
    }



</script>

<template>
    <div >
        <FullCalendar :options="calendarOptions"/>
        <Dialog v-model:visible="view" modal header="Schedule Details" :style="{ width: '65rem' }">
        
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" >
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> {{ event.title }} </td>
                    <td> {{ event.start }} </td>
                    <td> {{ event.end }} </td>
                    <td> {{ event.start_time }} </td>
                    <td> {{ event.end_time }} </td>
                </tr>
                </tbody>
            </table>
        </div>
    </Dialog>
    </div>
</template>


