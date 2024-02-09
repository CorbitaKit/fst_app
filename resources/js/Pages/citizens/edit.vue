<script setup>
    import {useForm} from '@inertiajs/vue3';
    import citizenForm from './forms/citizen-forms.vue'


    const props = defineProps({
        errors: Object,
        regions: Object,
        citizen: Object,
    })

    const form = useForm(props.citizen.data)




    function submit() {
        form.put('/citizens/'+props.citizen.data.id)
    }
    
</script>

<template>
    <citizenForm btnText ="Update Citizen" :errors="errors" :form="form" :regions="regions" @submit="submit"/>
</template>
