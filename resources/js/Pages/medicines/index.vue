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
    

    const list_view = ref(false)
    const is_creating = ref(false)
    const logs = ref(null)
    onMounted(() => {
        getMedicineJournal()
    })
    const getMedicineJournal = () => {
        is_creating.value = false
        axios.get('/logs/medicine/')
        .then(response => {
            logs.value = response.data
        })
    }

    const formatDate = (date, format) => {
        moment.locale('da')
        return moment(date).format(format);
    }

    const submit = () => {
        form.post('/medicines',{
            onSuccess: (() => {
                Swal.fire({
                    title: "Success!",
                    text: "Medicine added successfully!",
                    icon: "success"
                });
                
                getMedicineJournal()
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
                <Timeline :value="logs"  align="alternate" class="mt-5 mb-5" v-if="!list_view">
                    <template #marker="slotProps">
                        <span class="flex w-2rem h-2rem align-items-center justify-content-center text-white border-circle z-1 shadow-1" :style="{ backgroundColor: slotProps.item.color }">
                            <i :class="slotProps.item.icon"></i>
                        </span>
                    </template>
                    <template #content="slotProps">
                        <Card class="mt-3">
                            <template #title>
                                {{ slotProps.item.status }}
                            </template>
                            <template #subtitle>
                                {{ formatDate(slotProps.item.created_at, "D. MMMM YYYY HH:mm")}}
                            </template>
                            <template #content>
                                <p>
                                    {{ slotProps.item.user.name }} {{slotProps.item.action}}
                                </p>
                            </template>
                        </Card>
                    </template>
                </Timeline>
                <addMedicine :citizen_id="citizen_id" v-if="is_creating" @fetchMedicineJournal="getMedicineJournal" :form="form" @submit="submit"/>
                <!-- <medicineList :citizen_id="citizen_id" v-if="list_view" @fetchMedicineJournal="getMedicineJournal" @goBack="list_view = false"/> -->
            </div>
        </div>
        
    </div>
</template>