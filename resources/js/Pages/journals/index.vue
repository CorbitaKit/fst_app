<script setup>
    import journalBtns from '../journals/buttons.vue'
    import journalCreation from '../journals/create.vue'
    import journalEdit from '../journals/edit.vue'
    import { ref, onMounted } from 'vue'
    import moment from 'moment';
    import axios from 'axios';
    import Panel from 'primevue/panel';

    import Avatar from 'primevue/avatar';
    const props = defineProps({
        citizen_id: Number
    })
    const journals = ref(null)
    const journal_id = ref(null)
    const is_creating = ref(false)
    const is_updating = ref(false)
    const journal = ref(null)
    onMounted(() => {
        getCitizensJournal()
    })

    const getCitizensJournal = () => {
        
        axios.get('/journals/get-citizen-journal/' + props.citizen_id)
        .then(response => {
            is_creating.value = false
            is_updating.value = false
            journals.value = response.data
        })
    }
    


    const formatDate = (date) => {
        return moment(date).format('MMMM D, YYYY hh:mm A');
    }

    const createJournal = () => {
        is_creating.value = true
    }
    const setJournal = (data) => {
        axios.get('/journals/' + data)
        .then(response => {
            journal.value = response.data
            is_updating.value = true
            
        })
        
    };
</script>

<template>
    <div class="active tab-pane" id="journal">
        <div v-if="!is_creating && !is_updating">
            <div class="row mb-5">
                <div class="col-md-6">
                    <button type="button" @click.prevent="createJournal" class="btn bg-gradient-success mb-2 mr-2">
                        <i class="fas fa-plus"></i>
                        Add new journal
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <select class="form-control">
                                    <option>Sort Newest First</option>
                                    <option>Sort Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <input type="email" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" v-for="(journal, i) in journals" :key="i">
                <Panel toggleable>
                    <template #header>
                        <div class="flex align-items-center justify-content-between gap-2">
                            <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" size="large" shape="circle" />
                            <span class="font-bold">{{ journal.creator.name }}</span>
                        </div>
                    </template>
                    <template #footer>
                        <div class="flex flex-wrap align-items-right justify-content-between gap-3">
                            
                            
                            <journalBtns :journal="journal" @setJournalID="setJournal" @fetchJournals="getCitizensJournal"/>
                            <span class="p-text-secondary">{{ formatDate(journal.created_at) }}</span>
                        </div>
                    </template>
                    <p class="m-0" v-html="journal.content" ></p>
                </Panel>
            </div>
        </div>
        <journalCreation v-if="is_creating" @fetchJournals="getCitizensJournal" @cancelAction="is_creating = false" :citizen_id="citizen_id"/>
        <journalEdit v-if="is_updating" @fetchJournals="getCitizensJournal" @cancelAction="is_updating = false" :journal="journal" />
    </div>
</template>