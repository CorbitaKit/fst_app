<script setup>
import { useForm, router } from '@inertiajs/vue3';
import protocolForm from './form.vue'
import Swal from 'sweetalert2'
import { ref } from 'vue';
import axios from 'axios';

const form = useForm({
    'name': null,
    'start_date': null,
    'end_date': null,
    'citizens': [],
})

const errors = ref([])
const submit = () => {
    axios.post('/protocols', form)
    .then(() => {
        Swal.fire({
            title: "Success!",
            text: "Protocol added successfully!",
            icon: "success"
        });

        router.get('/protocols')
    }).catch(err => {
        errors.value = err.response.data.errors
    })
}
</script>

<template>
    <protocolForm :errors="errors" :form="form" :btnText="'Create new Protocol'" @submit="submit"/>
</template>