<script setup>
    import journalBtns from '../journals/buttons.vue'
    import journalCreation from '../journals/create.vue'
    import journalEdit from '../journals/edit.vue'
    import { ref, onMounted } from 'vue'
    import moment from 'moment';
    import axios from 'axios';
    import Panel from 'primevue/panel';

    
    const props = defineProps({
        citizen_id: Number
    })
    const journals = ref(null)
    const is_creating = ref(false)
    const is_updating = ref(false)
    const url = ref(null)
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
    


    const formatDate = (journal_date) => {
        
        const date = new Date(journal_date);
        const options = {day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: false // Use 24-hour format
        };
        const formattedDate = date.toLocaleDateString('da-DK', options);
        return formattedDate
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

    const filterJournal = (filter) => {
        if (filter == 'sort_asc') {
            url.value = '/journals/get-sorted-journals/' + props.citizen_id + '/asc' 
        } else if (filter == 'sort_desc') {
            url.value = '/journals/get-sorted-journals/' + props.citizen_id + '/desc'
        } else if (filter == 'locked') {
            url.value = '/journals/get-filtered-journal/' + props.citizen_id + '/is_lock'
        } else {
         
            url.value = '/journals/get-filtered-journal/' + props.citizen_id + '/is_favorite'
        }

        axios.get(url.value)
        .then(response => {
            journals.value = response.data
        })
    }
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
                            <Button @click="filterJournal('sort_desc')" v-tooltip="'Filter journals by descending order'" icon="pi pi-sort-alpha-down" class="mr-1" severity="secondary" rounded outlined aria-label="Bookmark" />
                            <Button @click="filterJournal('sort_asc')" v-tooltip="'Filter journals by ascending order'" icon="pi pi-sort-alpha-up-alt" class="mr-1" severity="secondary" rounded outlined aria-label="Bookmark" />
                            <Button @click="filterJournal('locked')" v-tooltip="'Filter journals by lock'" icon="pi pi-lock" class="mr-1" severity="secondary" rounded outlined aria-label="Bookmark" />
                            <Button @click="filterJournal('favorite')" v-tooltip="'Filter journals by favorite'" icon="pi pi-star-fill" class="mr-1" severity="secondary" rounded outlined aria-label="Bookmark" />
                        </div>
                        <div class="col-md-6">
                            <VueDatePicker v-model="date" range />
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <div class="card" v-for="(journal, i) in journals" :key="i">
                <Panel :class="{'draft-panel': journal.is_draft === 1}">
                    <template #header>
                        <div class="flex align-items-center justify-content-between gap-2">
                            <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" size="large" shape="circle" />
                            <span class="font-bold">{{ journal.creator.name }}</span>
                            
                            <span class="font-bold" v-if="journal.is_draft == 1"><i>(Drafted)</i></span>
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
<style scoped>
.draft-panel {
    background-color: rgb(211, 211, 224);
    opacity: .5
}
</style>