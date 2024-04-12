<script setup>
    import {router} from '@inertiajs/vue3';
    import axios from 'axios'
    import scheduleForm from './schedule.vue'
    import { ref } from 'vue'
    import { permissionChecker } from '../plugins/permission-checker';
    const props = defineProps({
        employees: Object,
        settings: Object
    })
    const { canAdd, canEdit, canDelete, popUp} = permissionChecker()
    const op = ref()
    const permissions = ref([])
    const employee= ref(null)
    const is_adding_schedule = ref(null)
    const addNewEmployee = () => {
        if (!canAdd()) {
            popUp()
            return
        }
        router.get('/employees/create')
    }



    const getPermissions = (userId) => {
        permissions.value = []
        axios.get('/permissions/' + userId)
        .then(response => {
            response.data.forEach( (permission) => {
                permissions.value.push({
                    'name': permission.name,
                    'id': permission.id,
                    'checked': permission.users.length === 0 ? false : true,
                    'user_id': userId
                })
            })
        })
    }
    const addSchedule = (emp) => {
        if (!canAdd()) {
            popUp()
            return
        }
        employee.value = emp
        is_adding_schedule.value = true
    }
    const toggle = (event, id) => {
        if (!canAdd()) {
            popUp()
            return
        }
        getPermissions(id)
        op.value.toggle(event);
    }

    const saveUserPermission = (permission) => {
        if (permission.checked) {
            axios.post('/permission-users', permission)
        } else {
            axios.delete('/permission-users/' + permission.id + '/' + permission.user_id)
        }
    }


    
    

</script>

<template>
    <scheduleForm :employee="employee" v-if="is_adding_schedule" :btnText="'Add Schedule'"/>
    
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
            <Column header="Role">
                <template #body="employee">
                    <p>{{ employee.data.user.role.name }}</p>
                </template>
            </Column>
           
            <Column header="Actions">
                <template #body="employee">
                    <div class="flex flex-wrap">
                        <Button v-tooltip.bottom="'Edit employee record'" class="mr-2" type="button"  icon="pi pi-file-edit" rounded severity="success" raised />
                        <Button v-tooltip.bottom="'Set employee permission'" class="mr-2" type="button"  icon="pi pi-lock" rounded severity="help" raised @click="(event) => toggle(event, employee.data.id)" aria-haspopup="true" aria-controls="overlay_panel" />
                        <OverlayPanel ref="op" appendTo="body">
                            <DataTable :value="permissions">
                                <Column field="name" header="Permission"></Column>
                                <Column header="Set">
                                    <template #body="permission">
                                            <InputSwitch v-model="permission.data.checked" @change="saveUserPermission(permission.data)"/>
                                    </template>
                                </Column>
                               
                               
                            </DataTable>
                        </OverlayPanel>
                        <Button @click="addSchedule(employee.data)" v-tooltip.bottom="'Set employee schedule'" class="mr-2" type="button"  icon="pi pi-calendar" rounded severity="info" raised />
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
    
</template>