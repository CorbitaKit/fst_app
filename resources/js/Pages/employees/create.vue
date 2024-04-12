<script setup>
import { useForm, router } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2'
import { ref } from 'vue';
import employeeForm from './form.vue'

const props = defineProps({
    roles: Object
})
const errors = ref([])
const form = useForm({
    'first_name': null,
    'last_name': null,
    'phone': null,
    'birth_day': null,
    'address': null,
    'email': null,
    'role': null,
    'permissions': [0]
})

const submit = () => {
    axios.post('/employees', form)
    .then(() => {
        Swal.fire({
            title: "Success!",
            text: "Company added successfully!",
            icon: "success"
        });
        router.get('/employees')
    }).catch(err => {
        errors.value = err.response.data.errors
    })
}
</script>

<template>
    <employeeForm :errors="errors" :form="form" :btnText="'Add Employee'" @submit="submit" :roles="roles"/>
</template>