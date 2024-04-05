<script setup>
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios'
import { ref, onMounted } from 'vue'
const props = defineProps({
    citizens: Object
})

const filter_start_date = ref()
const filter_end_date = ref()
const filter_citizens = ref([])
const protocols = ref()

onMounted(() => {
    axios.get('/protocols/get-protocols')
    .then(response => {
        protocols.value = response.data
    })
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

const setHeader = (protocol) => {
    return "Protocol: " + protocol.name + " Date " + getTodaysDate(protocol.start_date) + " to " + getTodaysDate(protocol.end_date)
}

const checkIfCanUpdate = (protocol_date) => {
    const date = new Date(protocol_date);
    const today = new Date();

    return date > today
}

const filterProtocol = () => {
    axios.get('/protocols/filter-protocol',{
        params:{
            'start_date': filter_start_date.value,
            'end_date': filter_end_date.value,
            'citizens': filter_citizens.value
        }
    }
    ).then(response => {
        protocols.value = response.data
    })
}
</script>

<template>
    <div class="flex flex-wrap align-items-center justify-content-between gap-2">
        <span class="text-xl text-900 font-bold">Protocol List</span>
        <Button label="Add new Protocol" @click="addNewProtocol"  icon="pi pi-plus" class="float-right" raised />
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <div class="flex flex-column">
                <label for="start_date">Start Date</label>
                <Calendar v-model="filter_start_date" dateFormat="dd, M yy" showIcon iconDisplay="input" inputId="icondisplay" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="flex flex-column">
                <label for="start_date">End Date</label>
                <Calendar v-model="filter_end_date" dateFormat="dd, M yy" showIcon iconDisplay="input" inputId="icondisplay" />
            </div>
        </div>
        <div class="col-md-5">
            <div class="flex flex-column">
                <label for="start_date">Citizens</label>
                <MultiSelect v-model="filter_citizens" display="chip" :options="citizens" :optionLabel="costumOptionLabel" placeholder="Select Citizens" />
            </div>
        </div>
        <div class="col-md-1">
            <div class="flex flex-column">
                <!-- <label for="start_date">Citizens</label> -->
                <Button label="Filter" icon="pi pi-filter" class="mt-5" @click="filterProtocol"/>
            </div>
        </div>
    </div>
    <div class="card">
        <Accordion :activeIndex="0">
            <AccordionTab v-for="protocol in protocols" :key="protocol.id" :header="setHeader(protocol)">
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
                            <td> {{ citizen.pivot.date }} </td>
                            <td> {{ citizen.first_name}} {{ citizen.last_name }} </td>
                            <td> {{ citizen.pivot.status }} </td>

                            <td>
                                <Button v-tooltip="'Mark citizen as absent'" @click="updateStatus(citizen, 'Absent')" :disabled="checkIfCanUpdate(citizen.pivot.date)" icon="pi pi-calendar-minus" severity="warning" text raised/>
                                <Button v-tooltip="'Mark citizen as attended'" @click="updateStatus(citizen, 'Attended')" :disabled="checkIfCanUpdate(citizen.pivot.date)" icon="pi pi-calendar-plus" severity="success" text raised/>
                                <Button v-tooltip="'Remove citizen for this date'" @click="removeCitizen(citizen)" icon="pi pi-trash" severity="danger" text raised/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </AccordionTab>
        </Accordion>
    </div>
</template>