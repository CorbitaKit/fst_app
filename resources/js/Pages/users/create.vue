<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import companyForm from './form.vue'
    import Swal from 'sweetalert2'

    const props = defineProps({
        company_id: Number
    })
    const form = useForm({
        'name': null,
        'email': null,
        'role_id': null,
        'password': null,
        'company_id': localStorage.getItem('company_id')
    })

    const submit = () => {
        form.post('/users', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "User added successfully!",
                    icon: "success"
                });

                router.get('/users/get-company-users/' + localStorage.getItem('company_id'))
            }
        })
    }
</script>

<template>
    <companyForm :form="form" :btnText="'Add User'" @submit="submit"/>
</template>