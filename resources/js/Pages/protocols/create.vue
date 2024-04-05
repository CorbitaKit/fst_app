<script setup>
import { useForm, router } from '@inertiajs/vue3';
import protocolForm from './form.vue'
import Swal from 'sweetalert2'

const form = useForm({
    'name': null,
    'start_date': null,
    'end_date': null,
    'citizens': [],
})

const submit = () => {
    form.post('/protocols', {
        onSuccess: () => {
            Swal.fire({
                title: "Success!",
                text: "Protocol added successfully!",
                icon: "success"
            });

            router.get('/protocols')
        }
    })
}
</script>

<template>
    <protocolForm :form="form" :btnText="'Create new Protocol'" @submit="submit"/>
</template>