<script setup>
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import axios from 'axios'
    import { router } from '@inertiajs/vue3'
    const props = defineProps({
        settings: Object
    })

    const updateSettings = (feature, status, action) => {
        Swal.fire({
        title: "Are you sure?",
        text: "You want to " + action +" this feature?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, " + action + " it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.patch('/settings/update-feature/' + props.settings.id + '/' + feature + '/' +status)
            .then(() => {
                Swal.fire({
                    title: "Success!",
                    text: "Feature has been " + action + "!",
                    icon: "success"
                });
                window.location.reload();
            })
        }
    });
    }
</script>

<template>
    <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" >
                <thead>
                <tr>
                    <th>Feature</th>
                    <th>Status</th>
                    <th>File Storage</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> Protocols </td>
                    <td>
                        <p v-if="settings.protocol == 0"> Active</p>
                        <p v-if="settings.protocol == 1"> Inactive</p>
                    </td>
                    <td> {{ settings.file_storage }} MB </td>
                    <td>
                        <Button @click="updateSettings('protocol', 1, 'Deactivate')" v-tooltip="'Deactivate protocol feature?'" v-if="settings.protocol == 0" icon="pi pi-ban" severity="warning"  rounded aria-label="Favorite" />
                        <Button @click="updateSettings('protocol', 0, 'Activate')" v-tooltip="'Activate protocol feature?'" v-if="settings.protocol == 1" icon="pi pi-bell" severity="success"  rounded aria-label="Favorite" />
                    </td>
                </tr>
                <tr>
                    <td> Duty Schedules </td>
                    <td>
                        <p v-if="settings.duty_schedule == 0"> Active</p>
                        <p v-if="settings.duty_schedule == 1"> Inactive</p>
                    </td>
                    <td> {{ settings.file_storage }} MB </td>
                    <td>
                        <Button @click="updateSettings('duty_schedule', 1, 'Deactivate')"  v-tooltip="'Deactivate duty schedule feature?'" v-if="settings.duty_schedule == 0" icon="pi pi-ban" severity="warning"  rounded aria-label="Favorite" />
                        <Button @click="updateSettings('duty_schedule', 0, 'Activate')" v-tooltip="'Activate duty schedule feature?'"  v-if="settings.duty_schedule == 1" icon="pi pi-bell" severity="success"  rounded aria-label="Favorite" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
</template>