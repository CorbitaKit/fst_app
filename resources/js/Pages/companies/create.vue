<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import companyForm from './form.vue'
    import Swal from 'sweetalert2'
    const form = useForm({
        'name': null,
        'status': 'Active'
    })

    const submit = () => {
        form.post('/companies', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Company added successfully!",
                    icon: "success"
                });

                router.get('/companies')
            }
        })
    }
</script>

<template>
    <companyForm :form="form" :btnText="'Add Company'" @submit="submit"/>
</template>