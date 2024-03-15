<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import Swal from 'sweetalert2'
    import companyForm from './form.vue'
    const props = defineProps({
        company: Object
    })

    const form = useForm(props.company)

    const submit = () => {
        form.put('/companies/' + props.company.id, {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Company updated successfully!",
                    icon: "success"
                });

                router.get('/companies')
            }
        })
    }
    
</script>

<template>
    <companyForm :form="form" :btnText="'Update Company'" @submit="submit" />
</template>