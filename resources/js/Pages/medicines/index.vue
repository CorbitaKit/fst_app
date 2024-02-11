<script setup>
    import addMedicine from '../medicines/create.vue'
    import medicineList from '../medicines/list.vue'
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    import moment from 'moment';
    import 'moment/locale/da'
    const props = defineProps({
        citizen: Object
    })

    const list_view = ref(false)
    const medicine_journals = ref(null)
    onMounted(() => {
        getMedicineJournal()
    })
    const getMedicineJournal = () => {
        axios.get('/medicine-journals/' + props.citizen.id)
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
        <div v-if="! list_view">
            <div>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <button type="button" class="btn bg-gradient-success mb-2 mr-2" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-plus"></i>
                            Give Medicine
                        </button>
                        <button type="button" class="btn bg-gradient-primary mb-2 mr-2" data-toggle="modal" data-target="#medList">
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
                <div v-if="med_journal.action == 'Add'">
                    <i class="fas fa-plus bg-primary"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> {{ formatDate(med_journal.created_at, "hh:mm A") }}</span>

                        <h3 class="timeline-header"><a href="#">{{ med_journal.user.name }}</a> gave {{ med_journal.citizen.first_name }} {{ med_journal.citizen.last_name }} a {{  med_journal.medicine.name }} medicine</h3>
                    </div>
                </div>
                <div v-if="med_journal.action == 'Delete'">
                    <i class="fas fa-trash bg-primary"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> {{ formatDate(med_journal.created_at, "H:mm") }}</span>

                        <h3 class="timeline-header"><a href="#">{{ med_journal.user.name }}</a> Deleted {{ med_journal.citizen.first_name }} {{ med_journal.citizen.last_name }}  {{  med_journal.medicine.name }}s medicine</h3>
                    </div>
                </div>
            </div>
        </div>
        <addMedicine :citizen_id="citizen.id"/>
        <medicineList :medicines="citizen.medicines"/>
    </div>
</template>