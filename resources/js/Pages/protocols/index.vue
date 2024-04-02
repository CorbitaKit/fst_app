<script setup>
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
const props = defineProps({
    protocols: Object,
    citizens: Object
})


const addNewProtocol = () => {
    router.get('/protocols/create')
}

const costumOptionLabel = (option) => {
    return `${option.first_name}  ${option.last_name}`
}

const getTodaysDate = (protocol_date) => {
    const date = new Date(protocol_date);
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    const formattedDate = date.toLocaleDateString('da-DK', options);

    return formattedDate
}

const removeCitizen = (citizen) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to remove this citizen for this date?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/protocols/remove-citizen-into-protocol' + '/' + citizen.pivot.id)
            .then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Citizen has been deleted.",
                    icon: "success"
                });
                router.get('/protocols/')
            })
        }
    });
}
const updateStatus = (citizen, status) => {
        Swal.fire({
        title: "Are you sure?",
        text: "You want to mark as " + status +" this citizen for this date?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, mark as " + status + "!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.patch('/protocols/mark-as-absent-citizen-into-protocol' + '/' + citizen.pivot.id + '/' + status)
            .then(() => {
                Swal.fire({
                    title: "Updated!",
                    text: "Citizen has been marked as " + status,
                    icon: "success"
                });
                router.get('/protocols/')
            })
        }
    });
}
</script>

<template>
    <div class="flex flex-wrap align-items-center justify-content-between gap-2">
        <span class="text-xl text-900 font-bold">Protocol List</span>
        <Button label="Add new Protocol" @click="addNewProtocol"  icon="pi pi-plus" class="float-right" raised />
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="flex flex-column">
                <label for="start_date">Start Date</label>
                <Calendar dateFormat="dd, M yy" showIcon iconDisplay="input" inputId="icondisplay" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="flex flex-column">
                <label for="start_date">End Date</label>
                <Calendar dateFormat="dd, M yy" showIcon iconDisplay="input" inputId="icondisplay" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="flex flex-column">
                <label for="start_date">Citizens</label>
                <MultiSelect display="chip" :options="citizens" :optionLabel="costumOptionLabel" placeholder="Select Citizens" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5" v-for="(protocol, i) in protocols" :key="i">
            <div class="card">
                <div class="flex flex-wrap align-items-center justify-content-between gap-2 p-2">
                    
                    <span class="text-md text-900 font-bold">{{ getTodaysDate(protocol.start_date) }} - {{ getTodaysDate(protocol.end_date) }}</span>
                    
                </div>
                <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" >
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Citizen</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr v-for="citizen in protocol.citizens" :key="citizen.id">
                    <td>
                        {{ citizen.pivot.date }}
                    </td>
                    <td>
                        {{ citizen.first_name }}
                        {{ citizen.last_name }}
                    </td>
                    <td> {{ citizen.pivot.status }}</td>
                    <td>
                        <Button @click="removeCitizen(citizen)"  v-tooltip="'Remove citizen in this protocol'" icon="pi pi-trash" class="mr-2" severity="danger" rounded  />
                        <Button @click="updateStatus(citizen, 'Absent')"  v-tooltip="'Mark citizen as absent'" icon="pi pi-calendar-minus" class="mr-2" severity="warning" rounded  />
                        <Button @click="updateStatus(citizen, 'Attended')"  v-tooltip="'Mark citizen as attended'" icon="pi pi-calendar-plus" severity="success" rounded  />
                    </td>
                    
                </tr>
                </tbody>
            </table>
        </div>
                
            </div>
        </div>
    </div>
    

        
</template>