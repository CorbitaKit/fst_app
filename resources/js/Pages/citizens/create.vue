<script setup>
    import {useForm, router} from '@inertiajs/vue3';
    import citizenForm from '../citizens/forms/citizen-forms.vue'
    import axios from 'axios'
    import { ref } from 'vue';


    const props = defineProps({
        regions: Object
    })
    const errors = ref([])
    const form = useForm({
        'email': null,
        'first_name': null,
        'last_name': null,
        'social_security_number': null,
        'birth_day': null,
        'phone': null,
        'address': null,
        'postcode': null,
        'city_id': null,
        'municipality_id': null,
        'region_id': null,
        'country': null,
        'note': null,
    })



    function submit() {

        axios.post('/citizens', form)
        .then(() => {
            Swal.fire({
                'title': 'Success',
                'text': 'Citizen added successfully!',
                'icon': 'success'
            })
            router.get('/citizens')
        }).catch(err => {
            errors.value = err.response.data.errors
        })
    }
    
</script>

<template>
    <citizenForm btnText ="Add New Citizen" :errors="errors" :form="form" :regions="regions" @submit="submit"/>
</template>
