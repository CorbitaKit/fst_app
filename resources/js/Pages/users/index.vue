<script setup>
    import {router} from '@inertiajs/vue3';
    import Swal from 'sweetalert2'
    const props = defineProps({
        users: Object
    })

    const addnewUser = () => {
        router.get('/users/create')
    }

    const edit = (company_id) => {
        router.get('/users/' + company_id + "/edit")
    }

    const destroy = (company_id) => {
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
                axios.delete('/users' + '/' + company_id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Company has been deleted.",
                        icon: "success"
                    });
                    router.get('/users')
                })
            }
        });
    }
    

</script>

<template>
    <div class="card">
        <DataTable :value="users" showGridlines paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" >
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">User Master List</span>
                    <Button label="Add new user" @click="addnewUser" icon="pi pi-plus" class="float-right" raised />
                </div>
            </template>
            <Column field="name" header="Name" />
            <Column field="email" header="Email" />
            <Column header="Role">
                <template #body="user">
                    <p>{{ user.data.role.name }}</p>
                </template>
            </Column>
                
            <Column header="Actions">
                <template #body="user">
                    <div class="flex flex-wrap">
                        
                        <Button @click="edit(user.data.id)" v-tooltip.bottom="'Edit company record'" class="mr-2" type="button"  icon="pi pi-file-edit" rounded severity="success" raised />
                        <Button @click="destroy(user.data.id)" v-tooltip.bottom="'Delete company record'" type="button" class="mr-2" icon="pi pi-trash" rounded severity="danger" raised />
                        
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>