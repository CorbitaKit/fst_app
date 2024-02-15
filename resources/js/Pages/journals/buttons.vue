<script setup>
    import axios from 'axios'
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import Button from 'primevue/button';
    import Dialog from 'primevue/dialog';
    import {ref} from 'vue';
    import Timeline from 'primevue/timeline';
    const props = defineProps({
        journal: Object
    })

    const emit = defineEmits(['fetchJournals', 'setJournalID'])
    const visible = ref(false)
    const logs = ref(null)
    const setJournalId = (journal_id) => {
        emit('setJournalID', journal_id)
    }

    const deleteJournal = (journal_id) => {
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
                axios.delete('/journals' + '/' + journal_id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    emit('fetchJournals')
                })
            }
        });
    }

    const updateJournal = (value, field, journal_id) => {
        let params = {}
        params[field] = value
        axios.patch('/journals/' + journal_id, params)
        .then(() => {
            emit('fetchJournals')
        })
    }

    const getJournalLogs = (journal_id) => {
        axios.get('/logs/journal/' + journal_id)
        .then((response) => {
            logs.value = response.data
            visible.value = true
        })
    }

    const formatDate = (date, format) => {
        moment.locale('da')
        return moment(date).format(format);
    }

</script>

<template>
    <div class="flex align-items-center gap-2">
        <Button @click="setJournalId(journal.id)" v-tooltip.bottom="'Edit journal'" icon="pi pi-file-edit" severity="secondary"  rounded text></Button>
        <Button @click="getJournalLogs(journal.id)" v-tooltip.bottom="'Time logs'" icon="pi pi-clock" severity="secondary" rounded text></Button>
        <Button v-if="journal.is_favorite == 0" @click="updateJournal(1, 'is_favorite', journal.id)" v-tooltip.bottom="'Add to favorite'" icon="pi pi-star" severity="secondary" rounded text></Button>
        <Button v-if="journal.is_favorite == 1" @click="updateJournal(0, 'is_favorite', journal.id)" v-tooltip.bottom="'Remove from favorite'" icon="pi pi-star-fill" severity="secondary" rounded text></Button>
        <Button v-if="journal.is_lock == 0" @click="updateJournal(1, 'is_lock', journal.id)" v-tooltip.bottom="'Lock journal'" icon="pi pi-lock-open" severity="secondary" rounded text></Button>
        <Button v-if="journal.is_lock == 1" @click="updateJournal(0, 'is_lock', journal.id)" v-tooltip.bottom="'Unlock journal'" icon="pi pi-lock" severity="secondary" rounded text></Button>
        <Button v-tooltip.bottom="'Print journal (not yet implemented)'" icon="pi pi-print" severity="secondary" rounded text></Button>
        <Button @click="deleteJournal(journal.id)" v-tooltip.bottom="'Delete journal'" icon="pi pi-trash" severity="secondary" rounded text></Button>
    </div>

    <Dialog v-model:visible="visible" modal header="Journal Time Logs" :style="{ width: '50rem' }">
        <div class="card">
            <Timeline :value="logs">
                <template #opposite="slotProps">
                    <small class="p-text-secondary">{{ formatDate(slotProps.item.created_at, "D. MMMM YYYY HH:mm")}}</small>
                </template>
                <template #content="slotProps">
                    {{ slotProps.item.user.name }} {{slotProps.item.action}}
                </template>
            </Timeline>
        </div>
    </Dialog>
</template>