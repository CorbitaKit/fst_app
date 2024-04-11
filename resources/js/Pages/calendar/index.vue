<script setup>
    import { useForm, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import InterActionPlugin from '@fullcalendar/interaction';
    import Swal from 'sweetalert2';
    import axios from 'axios';
    import CreateEvent from './create.vue'
    import ViewEvent from './view.vue'
    const props = defineProps({
        employee_id: Number,
        form: Object,
        right: String
    })

    const multiple_days = ref(false)
    const key = ref(0)
    const create = ref(false)
    const view =ref(false)
    const ids = ref([props.employee_id])
    const event = ref()
    const employees = ref()
    const filter = ref(false)
    const selectedEmployees = ref()
    const calendar = ref(null)
    const form = useForm(props.form)
    const calendarOptions = {
        timeZone: 'UTC',
        plugins: [dayGridPlugin, timeGridPlugin, InterActionPlugin],
        headerToolbar: {
          right: props.right,
          center: 'title',
          left: 'dayGridMonth,timeGridWeek,timeGridDay',

        },

        customButtons: {
          input: {
            text: 'Filter Calendar',
            click: () => {
                
                axios.get('/employees/get-employees')
                .then(response => {
                    employees.value = response.data
                    filter.value =true
                })
            }
          },
          reset: {
            text: 'Reset Filter',
            click: () => {
                ids.value = []
                ids.value.push(props.employee_id)
                calendar.value.getApi().removeAllEvents();
                calendar.value.getApi().addEventSource( '/schedules/get-employee-schedule/' + JSON.stringify(ids.value))
            }
          }
        },
        
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        lazyFetching: true,
        events: '/schedules/get-employee-schedule/' + JSON.stringify(ids.value),
        eventClick: (arg) => {
           axios.get('/schedules/' + arg.event.id)
           .then(response => {
            event.value = response.data
            view.value = true
           })
        },
        select: (info) => {
            form.start = info.start
            form.end = info.end
           
            
            if (checkForMultipleDays(new Date(info.startStr), new Date(info.endStr))) {
                multiple_days.value = true
            }

            create.value = true

           
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

    const submit = () => {
        form.post('/schedules', {
            onSuccess: () => {
                create.value = false
                Swal.fire({
                    'title': 'Success',
                    'text': 'Schedule created successfully',
                    'icon': 'success'
                })
                calendar.value.getApi().refetchEvents()
            }
        })
    }

    const filterEvent = () => {
        ids.value = []
        selectedEmployees.value.forEach((employee) => {
            ids.value.push(employee.id)
        })
        filter.value = false
        calendar.value.getApi().removeAllEvents();
        calendar.value.getApi().addEventSource( '/schedules/get-employee-schedule/' + JSON.stringify(ids.value))
        
    }

    const checkForMultipleDays = (start, end) => {
        const oneDayInMillis = 24 * 60 * 60 * 1000;
        const diff = Math.abs(start.getTime() - end.getTime());
        return diff === oneDayInMillis;
    }

    
</script>
<style>
    .fc-daygrid-event-harness {
        padding:5px;
    }
</style>
<template>
    <div >
        <FullCalendar ref="calendar" :options="calendarOptions" :key="key" />
    </div>

    <CreateEvent v-model:visible="create" :multiple_days="multiple_days" @submit="submit" :form="form" @cancel="create = false" />
    <ViewEvent v-model:visible="view" :event="event" @updateCalendar="key += 1" @hideDialog="view = false"/>

    <Dialog v-model:visible="filter" modal header="Filter Event" :style="{ width: '25rem' }">
        <MultiSelect class="mb-2 w-full" v-model="selectedEmployees" display="chip" :options="employees" optionLabel="user.name" placeholder="Select Employees">
            <template>
                <div class="flex align-items-center">
                    <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" size="large" shape="circle" />
                </div>
            </template>
        </MultiSelect>
        <div class="flex justify-content-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="filter = false"></Button>
            <Button type="button" label="Filter" @click="filterEvent"></Button>
        </div>
    </Dialog>
</template>


