<script setup>
    import {router} from '@inertiajs/vue3';
    import Swal from 'sweetalert2'
    const props = defineProps({
        companies: Object
    })

    const addNewCompany = () => {
        router.get('/companies/create')
    }

    const edit = (company_id) => {
        router.get('/companies/' + company_id + "/edit")
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
                axios.delete('/companies' + '/' + company_id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Company has been deleted.",
                        icon: "success"
                    });
                    router.get('/companies/')
                })
            }
        });
    }

    const users =  (company_id) => {
        localStorage.setItem('company_id', company_id)
        router.get('/users/get-company-users/' + company_id)
    }
    

</script>

<template>
    <div class="card">
        <DataTable :value="companies" showGridlines paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" >
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">Company List</span>
                    <Button label="Add new company" @click="addNewCompany" icon="pi pi-plus" class="float-right" raised />
                </div>
            </template>
            <Column field="name" header="Company Name" />
            <Column field="status" header="Status" />
           
            <Column header="Actions">
                <template #body="company">
                    <div class="flex flex-wrap">
                        <Button @click="users(company.data.id)" v-tooltip.bottom="'View company users'" class="mr-2"  icon="pi pi-eye" rounded severity="info" raised />
                        <Button @click="edit(company.data.id)" v-tooltip.bottom="'Edit company record'" class="mr-2" type="button"  icon="pi pi-file-edit" rounded severity="success" raised />
                        <Button @click="destroy(company.data.id)" v-tooltip.bottom="'Delete company record'" type="button" class="mr-2" icon="pi pi-trash" rounded severity="danger" raised />
                        <Button v-tooltip.bottom="'Login to this company'" type="button"  icon="pi pi-directions" rounded severity="warning" raised />
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>