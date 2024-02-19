<script setup>
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import Button from 'primevue/button';
    import addMedicine from '../medicines/create.vue'
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        citizen_id: Number
    })

    const emit = defineEmits(['fetchMedicineJournal', 'goBack'])

    const medicines = ref(null)
    const medicine = ref({})
    const is_updating = ref(false)

    onMounted(() => {
        fetchMedicines()
    })

    const fetchMedicines = () => {
        axios.get('/medicines/get-citizen-medicines/' + props.citizen_id)
        .then((response) => {
            medicines.value = response.data
        })
    }

    const deleteMedicine = (id) => {
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
                axios.delete('/medicines' + '/' + id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Medicine has been deleted.",
                        icon: "success",
                    });
                    emit('fetchMedicineJournal')
                    fetchMedicines()
                })
            }
        });
    }

    const edit = (id) => {

        is_updating.value = true
        axios.get('/medicines/' + id)
        .then(response=> {
            medicine.value = response.data
           
        })
    }

    const submit = () => {
        axios.put('/medicines/' + medicine.value.id, medicine.value)
        .then((response) => {
            fetchMedicines()
            Swal.fire({
                title: "Updated!!",
                text: "Medicine updated successfully!",
                icon: "success",
            });

            emit('fetchMedicineJournal')
        })

        
    }

   
</script>

<template>
    <DataTable :value="medicines" tableStyle="min-width: 50rem">
        <template #header>
            <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                <span class="text-xl text-900 font-bold">Medicines</span>
                <Button icon="pi pi-arrow-left" v-tooltip.bottom="'Go Back'" rounded raised @click="$emit('goBack')"/>
            </div>
        </template>
        <Column field="name" header="Name"></Column>
        <Column field="date_given" header="Date Given"></Column>
        <Column field="description" header="Reason"></Column>
        <Column header="Actions">
            <template #body="medicine">
                <div class="flex flex-wrap">
                    <Button @click="edit(medicine.data.id)" v-tooltip.bottom="'Edit medicine record'" class="mr-2" type="button" data-toggle="modal" data-target="#modal-default"  icon="pi pi-file-edit" rounded severity="success" raised />
                    <Button @click="deleteMedicine(medicine.data.id)"  v-tooltip.bottom="'Delete medicine record'" type="button"  icon="pi pi-trash" rounded severity="danger" raised />
                </div>
            </template>
        </Column>
       
    </DataTable>
    <addMedicine :form="medicine" v-if="is_updating" @submit="submit"/>
</template>