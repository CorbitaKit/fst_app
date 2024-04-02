<script setup>
    import { useForm, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import InterActionPlugin from '@fullcalendar/interaction';
    import Swal from 'sweetalert2';
    import axios from 'axios';
    const props = defineProps({
        employee_id: Number,
    })

   
    const key = ref(0)
    const create = ref(false)
    const view =ref(false)
    const ids = ref([props.employee_id])
    const event = ref()
    const employees = ref()
    const filter = ref(false)
    const selectedEmployees = ref()
    const calendar = ref(null)
    const form = useForm({
        'start': null,
        'end': null,
        'title': null,
        'start_time': null,
        'end_time': null,
        'employee_id': props.employee_id,
        'type': 'event',
        'is_public': 1
    })
    const calendarOptions = {
        timeZone: 'UTC',
        plugins: [dayGridPlugin, timeGridPlugin, InterActionPlugin],
        headerToolbar: {
          right: 'prev,next today input reset',
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
        calendar.value.getApi().removeAllEvents();
        calendar.value.getApi().addEventSource( '/schedules/get-employee-schedule/' + JSON.stringify(ids.value))
        
    }

    const destroy = (event_id) => {
        view.value = false
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/schedules' + '/' + event_id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "event has been deleted.",
                        icon: "success"
                    });
                    key.value +=1
                })
            }
        });
    }

    const markAsPrivate = (event_id) => {
        view.value = false
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
        confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, pivate it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios.patch('/schedules/mark-as-private' + '/' + event_id)
                .then(() => {
                    Swal.fire({
                        title: "Updated!",
                        text: "event has been mark as private.",
                        icon: "success"
                    });
                    key.value +=1
                })
            }
        });
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

    <Dialog v-model:visible="create" modal header="Create Event" :style="{ width: '35rem' }">
        <div class="flex flex-column mb-3">
            <label for="name">Name</label>
            <InputText id="name" v-model="form.title"  aria-describedby="last_name-help"/>
        </div>
        <div class="row">
           
            <div class="col-md-6">
                <label for="start_time">Start Time</label>
                    <InputMask v-model="form.start_time" mask="99:99" max="24"/>
            </div>
            <div class="col-md-6">
                <div class="flex flex-column">
                    <label for="start_time">End Time</label>
                    <InputMask v-model="form.end_time" mask="99:99" max="24"/>
                </div>
            </div>
       </div>
       
        <div class="flex justify-content-end mt-3">
            <Button type="button" label="Cancel" severity="secondary" @click="create = false"></Button>
            <Button type="button" label="Save" @click="submit"></Button>
        </div>
    </Dialog>

    <Dialog v-model:visible="view" modal header="Event Details" :style="{ width: '65rem' }">
        
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" >
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> {{ event.title }} </td>
                    <td> {{ event.start }} </td>
                    <td> {{ event.end }} </td>
                    <td> {{ event.start_time }} </td>
                    <td> {{ event.end_time }} </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success mr-1" @click="markAsPrivate(event.id)">
                            <i class="fas fa-lock"></i> Set as private event
                        </button>
                        <button type="button" class="btn btn-sm btn-danger mr-1" @click="destroy(event.id)">
                            <i class="fas fa-trash"></i> Delete Event
                        </button>
                        
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </Dialog>

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


