<script setup>
    import { useForm } from '@inertiajs/vue3';
    import journalForm from '../journals/forms/journal-form.vue';
    import Swal from 'sweetalert2'

    const props = defineProps({
        citizen_id: Number,
    })

    const form = useForm({
        'title': null,
        'date': null,
        'content': null,
        'is_draft': 0,
        'is_lock': 0,
        'is_favorite': 0, 
        'citizen_id': props.citizen_id,
    })

    
    const submit = () => {
        form.post('/journals', {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Journal added successfully!",
                    icon: "success"
                });
                emit('fetchJournals')
            }
        })
    }
  
    const emit = defineEmits(['cancelAction', 'fetchJournals'])
    

</script>
<style scoped>
    .ql-container ql-snow{
        height: 200px !important;
    }
</style>
<template>
    <journalForm @submit="submit" :form="form" @cancelAction="$emit('cancelAction')" />
</template>