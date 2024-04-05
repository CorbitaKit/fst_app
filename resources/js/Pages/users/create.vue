<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import companyForm from './form.vue'
    import Swal from 'sweetalert2'
    const props = defineProps({
        company_id: Number,
        permissions: Object,
        errors: Object,
    })
    const form = useForm({
        'first_name': null,
        'last_name': null,
        'phone': null,
        'address': null,
        'birth_day': null,
        'email': null,
        'role': null,
        'company_id': localStorage.getItem('company_id'),
        'permissions': null
    })

    const submit = () => {
        form.post('/employees',{
            onSuccess: (() => {
                Swal.fire({
                    'title': "Success",
                    'text': 'User added successfully!',
                    'icon': 'success'
                })
                router.get('/companies')
            })
        })
    }
</script>

<template>
    <companyForm :errors="errors" :permissions="permissions" :form="form" :btnText="'Add User'" @submit="submit"/>
</template>