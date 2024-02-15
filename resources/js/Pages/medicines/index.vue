<script setup>
    import addMedicine from '../medicines/create.vue'
    import medicineList from '../medicines/list.vue'
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    import moment from 'moment';
    import 'moment/locale/da'
    const props = defineProps({
        citizen_id: Number
    })

    const list_view = ref(false)
    const is_creating = ref(false)
    const medicine_journals = ref(null)
    onMounted(() => {
        getMedicineJournal()
    })
    const getMedicineJournal = () => {
        is_creating.value = false
        axios.get('/medicine-journals/' + props.citizen_id)
        .then(response => {
            medicine_journals.value = response.data
        })
    }

    const formatDate = (date, format) => {
        moment.locale('da')
        return moment(date).format(format);
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
                        <button type="button" @click="list_view = true" class="btn bg-gradient-primary mb-2 mr-2" data-toggle="modal" data-target="#medList">
                            <i class="fas fa-list"></i>
                            Show all Citizens Medicine
                        </button>
                    </div>
                </div>
            </div>

            <div class="timeline timeline-inverse"  v-for="(med_journal, i) in medicine_journals" :key="i">
                <div class="time-label">
                    <span class="bg-danger">
                        {{ formatDate(med_journal.created_at, "D. MMMM YYYY") }}
                    </span>
                </div>
             
                    <div v-for="(journal, k) in med_journal" :key="k">
                        <i class="fas fa-plus bg-primary" v-if="journal.action == 'Add'"></i>
                        <i class="fas fa-trash bg-primary" v-else></i>

                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{ formatDate(journal.created_at, "hh:mm A") }}</span>

                            <h3 class="timeline-header"><a href="#">{{ journal.user.name }}</a> {{ journal.action }} {{ journal.citizen.first_name }} {{ journal.citizen.last_name }} a {{  journal.medicine.name }} medicine</h3>
                        </div>
                        

                    </div>
                
            </div>
        </div>
        <addMedicine :citizen_id="citizen_id" v-if="is_creating" @fetchMedicineJournal="getMedicineJournal"/>
        <medicineList :citizen_id="citizen_id" v-if="list_view" @fetchMedicineJournal="getMedicineJournal"/>
    </div>
</template>