<script setup>
    import { useForm } from '@inertiajs/vue3';
    import Calendar from '../calendar/index.vue'
    const props = defineProps({
        employee_id: Number,
    })

    const form = useForm({
        'start': null,
        'end': null,
        'title': null,
        'start_time': null,
        'end_time': null,
        'employee_id': props.employee_id,
        'type': 'event',
        'is_public': 1
    })

</script>

<template>
   <Calendar :form="form" :employee_id="employee_id" :right="'prev,next today input reset'"/>
</template>


