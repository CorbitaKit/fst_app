<script setup>
    import addMedicine from '../medicines/create.vue'
    import medicineList from '../medicines/list.vue'
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    import moment from 'moment';
    import Button from 'primevue/button';
    import 'moment/locale/da'
    import Timeline from 'primevue/timeline';
    import Card from 'primevue/card';
    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    const props = defineProps({
        citizen_id: Number
    })

    const form = useForm({
        'name': null,
        'date_given': null,
        'description': null,
        'citizen_id': props.citizen_id

    })
    
    const is_creating = ref(false)

    const submit = () => {
        form.post('/medicines',{
            onSuccess: (() => {
                Swal.fire({
                    title: "Success!",
                    text: "Medicine added successfully!",
                    icon: "success"
                });
                
                
            })
        })
    }
</script>

<template>
    <div class="tab-pane" id="medJournal">
        <div>
            <div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <button type="button" @click="is_creating = true" class="btn bg-gradient-success mb-2 mr-2" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-plus"></i>
                            Give Medicine
                        </button>
                       
                    </div>
                </div>
            </div>
            <div class="card">
               
                <addMedicine :citizen_id="citizen_id" v-if="is_creating" @fetchMedicineJournal="getMedicineJournal" :form="form" @submit="submit"/>
                <medicineList :citizen_id="citizen_id" />
            </div>
        </div>
        
    </div>
</template>