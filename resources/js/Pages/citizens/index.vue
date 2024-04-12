<script setup>
    import {router} from '@inertiajs/vue3';
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import { ref } from 'vue'
    import { permissionChecker } from '../plugins/permission-checker';
    permissionChecker
    const props = defineProps({
        citizens: Object
    })

    const {canAdd, canEdit, canDelete, popUp} = permissionChecker()
    const data = ref([])
    const op = ref();
    const toggle = (event) => {
        op.value.toggle(event);
    };
    const createNewCitizen = () => {

        if (!canAdd()) {
            popUp()
            return
        }
        router.get('/citizens/create')
    }

    const show = (id) => {
        router.get('/citizens/'+id)
    }

    const edit = (id) => {
        if (!canEdit()) {
            popUp()
            return
        }
        router.get('/citizens/' + id +"/edit")
    }
    const destroy = (id) => {
        if (!canDelete()) {
            popUp()
            return
        }
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
                axios.delete('/citizens' + '/' + id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Citizen has been deleted.",
                        icon: "success"
                    });
                    router.get('/citizens/')
                })
            }
        });
    }
   
</script>

<template>
    
    <div class="card">
        <DataTable :value="citizens" showGridlines paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" >
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">Citizen List</span>
                    <div>
                       
                        <Button label="Add new citizen" @click="createNewCitizen" icon="pi pi-plus" class="float-right" raised />

                    </div>
                    
                </div>
            </template>
            <Column field="first_name" header="First Name" />
            <Column field="last_name" header="Last Name" />
            <Column field="email" header="Email" />
            <Column field="phone" header="Phone" />
            <Column header="Actions">
                <template #body="citizen">
                    <div class="flex flex-wrap">
                        <Button @click="show(citizen.data.id)"  v-tooltip.bottom="'View citizens details'" class="mr-2"  icon="pi pi-eye" rounded severity="info" raised />
                        <Button @click="edit(citizen.data.id)"  v-tooltip.bottom="'Edit Citizens record'" class="mr-2" type="button"  icon="pi pi-file-edit" rounded severity="success" raised />
                        <Button @click="destroy(citizen.data.id)"  v-tooltip.bottom="'Delete Citizens record'" class="mr-2" type="button"  icon="pi pi-trash" rounded severity="danger" raised />
                        <Button @click="toggle"  v-tooltip.bottom="'Show citizen notes'" type="button"  icon="pi pi-bars" rounded severity="help" raised />
                    </div>
                    <OverlayPanel ref="op" appendTo="body">
                        <div class="card flex flex-column gap-3 w-30rem" v-for="(journal, i) in citizen.data.journals" :key="i">
                            <Panel>
                                <p class="m-0" v-html="journal.content" ></p>
                            </Panel>
                        </div>
                    </OverlayPanel>
                </template>
            </Column>
        </DataTable>
    </div>
    
    
</template>
