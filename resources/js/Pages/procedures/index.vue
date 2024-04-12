<script setup>
import { useForm, router } from "@inertiajs/vue3";
import EmployeeProcedure from './employee-procedure.vue'
import Swal from "sweetalert2";

const props = defineProps({
    procedures: Object,
    employees: Object
})
const addNewProcedure = () => {
    router.get('/procedures/create')
}

</script>

<template>
     <div class="flex flex-wrap align-items-center justify-content-between gap-2">
        <span class="text-xl text-900 font-bold">Procedure List</span>
        <Button label="Add new Procedure" @click="addNewProcedure"  icon="pi pi-plus" class="float-right" raised />
    </div>
     <div class="row mt-5">
        <div class="col-md-3">
            <EmployeeProcedure :employees="employees"/>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
       
                    <Accordion :activeIndex="0">
                        <AccordionTab v-for="procedure in procedures" :key="procedure.id" :header="procedure.name">
                            <p class="m-0" v-html="procedure.description"></p>
                            <div class="flex align-items-center gap-2">
                                <Button v-tooltip.bottom="'Edit procedure'" icon="pi pi-file-edit" severity="info" rounded text></Button>
                                <Button v-tooltip.bottom="'Delete procedure'" icon="pi pi-trash" severity="danger" rounded text></Button>
                            </div>
                        </AccordionTab>
                    </Accordion>
                </div>
            </div>
        </div>
     </div>
</template>