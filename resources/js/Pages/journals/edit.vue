<script setup>

    import { ref } from 'vue';;
    import journalForm from '../journals/forms/journal-form.vue'
    import { useForm } from '@inertiajs/vue3'  
    import Swal from 'sweetalert2'

    const emit = defineEmits(['cancelAction', 'fetchJournals'])
    const props = defineProps({
        journal: Object,
    })

    const form = useForm(props.journal)
    const journal = ref(null)

    const submit = () => {
        form.put('/journals/' + props.journal.id, {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Journal updated successfully!",
                    icon: "success"
                });
                emit('fetchJournals')
            }
        })
    }

   



</script>
<template>
    <journalForm :form="form" @submit="submit" @cancelAction="$emit('cancelAction')"/>
</template>