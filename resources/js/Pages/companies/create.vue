<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import companyForm from './form.vue'
    import Swal from 'sweetalert2'
    import axios from 'axios'
    import { ref } from 'vue'

    const form = useForm({

        'name': null,
        'status': 'Active'
    })
    const errors = ref([])
    const submit = () => {
        axios.post('/companies', form)
        .then(() => {
            Swal.fire({
                title: "Success!",
                text: "Company added successfully!",
                icon: "success"
            });
            router.get('/companies')
        }).catch(err => {
            errors.value = err.response.data.errors
        })
    }
</script>

<template>
    <companyForm :form="form" :errors="errors" :btnText="'Add Company'" @submit="submit"/>
</template>