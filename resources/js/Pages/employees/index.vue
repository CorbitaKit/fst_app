<script setup>
    import {router} from '@inertiajs/vue3';
    import Swal from 'sweetalert2'
    import axios from 'axios'
    import scheduleForm from './schedule.vue'
    import { ref } from 'vue'
    const props = defineProps({
        employees: Object
    })

    const employee_id = ref(null)
    const is_adding_schedule = ref(null)
    const addNewEmployee = () => {
        router.get('/employees/create')
    }

    const edit = (company_id) => {
        router.get('/users/' + company_id + "/edit")
    }

    const addSchedule = (id) => {
        employee_id.value = id
        is_adding_schedule.value = true
    }

    

</script>

<template>
    <scheduleForm :employee_id="employee_id" v-if="is_adding_schedule" :btnText="'Add Schedule'"/>
    <div class="card" v-if="!is_adding_schedule">
        <DataTable :value="employees" showGridlines paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" >
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">User Master List</span>
                    <Button label="Add new employee" @click="addNewEmployee" icon="pi pi-plus" class="float-right" raised />
                </div>
            </template>
            <Column field="first_name" header="First Name" />
            <Column field="last_name" header="Last Name" />
            <Column field="phone" header="Phone Number" />
            <Column field="email" header="Email" />
           
            <Column header="Actions">
                <template #body="employee">
                    <div class="flex flex-wrap">
                        
                        <Button v-tooltip.bottom="'View employee users'" class="mr-2"  icon="pi pi-eye" rounded severity="info" raised />
                        <Button v-tooltip.bottom="'Edit employee record'" class="mr-2" type="button"  icon="pi pi-file-edit" rounded severity="success" raised />
                        <Button @click="addSchedule(employee.data.id)" v-tooltip.bottom="'Set employee schedule'" class="mr-2" type="button"  icon="pi pi-calendar" rounded severity="warning" raised />
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
    
</template>