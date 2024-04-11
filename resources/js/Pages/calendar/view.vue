<script setup>
    import axios from 'axios';
    import Swal from 'sweetalert2';
    const props = defineProps({
        event: Object
    })

    const emit = defineEmits(['updateCalendar', 'hideDialog'])

    const destroy = (event_id) => {
        emit('hideDialog')
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

                    emit('updateCalendar')
                })
            }
        });
    }

    const markAsPrivate = (event_id) => {
        emit('hideDialog')
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
                    emit('updateCalendar')
                })
            }
        });
    }
</script>

<template>
    <Dialog  modal header="Event Details" :style="{ width: '65rem' }">
        
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
</template>