<script setup>
    import { useForm, router } from '@inertiajs/vue3';
    import { onMounted, ref } from 'vue';
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import InterActionPlugin from '@fullcalendar/interaction';
    import axios from 'axios';
    import Swal from 'sweetalert2';
    const props = defineProps({
        employee_id: Number,
    })
    const key = ref(0)
    const fetchEvents =  () => {
        axios.get('/schedules/get-employee-schedule/' + props.employee_id)
        .then(response => {
           
        })
    };
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
        events: '/schedules/get-employee-schedule/' + props.employee_id,
        eventClick: (arg) => {
            
        },
        select: (info) => {
            
            Swal.fire({
            title: "Enter event name",
            input: "text",
            inputAttributes: {
                autocapitalize: "on"
            },
            showCancelButton: true,
            confirmButtonText: "Create Event",
            showLoaderOnConfirm: true,
            preConfirm: async (title) => {
                try {
                    const form = useForm({
                        'start': info.startStr,
                        'end': info.endStr,
                        'employee_id': props.employee_id,
                        'title': title,
                        'is_public': 0
                    })

                    form.post('/schedules', {
                        onSuccess: () => {
                            Swal.fire({
                                'title': 'Success',
                                'text': 'Schedule added successfully',
                                'icon': 'success'
                            })
                            key.value += 1
                        }
                    })
                
                } catch (error) {
               
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
            })
        },
        eventDrop: (arg) => {
            
            updateEvent(arg)
        },
        eventResize: (arg) => {
            updateEvent(arg)
        }
    }

    const updateEvent = (arg) => {
        const form = useForm({
            'start': arg.event.startStr,
            'end': arg.event.endStr,
            'employee_id': props.employee_id,
            'title': arg.event.title
        })

        form.put('/schedules/' + arg.event.id, {
            onSuccess: () => {
                Swal.fire({
                    'title': 'Success',
                    'text': 'Schedule updated successfully',
                    'icon': 'success'
                })
                key.value += 1
            }
        })

        
    }

</script>
<style>
    .fc-daygrid-event-harness {
        padding:5px;
    }
</style>
<template>
    <div >
        <FullCalendar :options="calendarOptions" :key="key"/>
    </div>
</template>


