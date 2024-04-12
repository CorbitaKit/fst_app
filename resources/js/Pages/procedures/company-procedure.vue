<script setup>
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";



const props = defineProps({
    procedures: Object,
    rate: Number
})

const markAsComplete = (procedure_id) => {
    Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Complete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get('/employee-procedure/complete' + '/' + procedure_id)
                .then(() => {
                    Swal.fire({
                        title: "Success!",
                        text: "Procedure has been marked as completed.",
                        icon: "success"
                    });
                })
            }
        });
}
const value = ref(props.rate)
</script>

<template>
     <div class="row mt-5">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body flex align-items-center ">
                    <Knob v-model="value" :size="200" disabled/>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <Panel class="mb-3" v-for="procedure in procedures" :key="procedure.id" :header="procedure.name" toggleable>
                        <p class="m-0" v-html="procedure.description">
                           
                        </p>
                        <template #footer>
                            <div class="flex flex-wrap align-items-center justify-content-between gap-3">
                                <div class="flex align-items-center gap-2">
                                    
                                </div>
                                <span class="p-text-secondary">
                                    <Badge value="Completed" severity="success" v-if="procedure.completed == 1"></Badge>
                                    <Button @click="markAsComplete(procedure.id)" v-tooltip.bottom="'Mark procedure as complete'" icon="pi pi-check" v-if="procedure.completed == 0" severity="secondary" rounded text></Button>
                                </span>
                            </div>
                        </template>
                    </Panel>
       
                </div>
            </div>
        </div>
     </div>
</template>

<style>
.p-knob{
    margin-left:20px;
} 
</style>