<script setup>
    import {useForm} from '@inertiajs/vue3';
    import citizenForm from '../citizens/forms/citizen-forms.vue'


    const props = defineProps({
        errors: Object,
        regions: Object
    })

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
        form.post('/citizens',{
            onError: ((error) => {
                console.log(error)
            })
        })
    }
    
</script>

<template>
    <citizenForm btnText ="Add New Citizen" :errors="errors" :form="form" :regions="regions" @submit="submit"/>
</template>
