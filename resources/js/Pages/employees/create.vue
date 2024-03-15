<script setup>
import { useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import employeeForm from './form.vue'
const form = useForm({
    'first_name': null,
    'last_name': null,
    'phone': null,
    'birth_day': null,
    'address': null,
    'email': null
})

const submit = () => {
    form.post('/employees', {
        onSuccess: () => {
            Swal.fire({
                title: "Success!",
                text: "Company added successfully!",
                icon: "success"
            });

            router.get('/employees')
        }
    })
}
</script>

<template>
    <employeeForm :form="form" :btnText="'Add Employee'" @submit="submit"/>
</template>