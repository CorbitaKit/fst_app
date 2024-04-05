<script setup>
    import { useForm } from '@inertiajs/vue3';
    import Calendar from '../calendar/index.vue';
    const props = defineProps({
        employee: Object,
        btnText: String
    })

    const form = useForm({
        'start': null,
        'end': null,
        'title': null,
        'start_time': null,
        'end_time': null,
        'employee_id': props.employee.id,
        'type': 'Schedule',
        'is_public': 1
    })

</script>

<template>
    <div>
        <div>
            <span class="text-xl ml-3 text-900 font-bold">Now showing duty schedule of: {{ employee.first_name }} {{ employee.last_name }}</span>
        </div>
        <Calendar :form="form" :employee_id="employee.id" :right="'prev,next today'"/>
    </div>
</template>


