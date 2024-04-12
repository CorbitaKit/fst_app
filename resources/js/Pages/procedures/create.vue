<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import Swal from 'sweetalert2'
    import ProcedureForm from './form.vue'

    const form = useForm({
        'name': null,
        'description': null
    })

    const submit = () => {
        form.post('/procedures', {
            onSuccess: () => {
                Swal.fire({
                    'title': 'Success',
                    'text': 'Procedure created successfully!',
                    'icon': 'success'
                })
                router.get('/procedures')
            }
        })
    }

</script>

<template>
    <ProcedureForm :form="form" @submit="submit" />
</template>