<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import Form from '../procedures/form.vue'
const form = useForm({
    'name': '',
    'description': ''
})

const submit = () =>{
    form.post('/features', {
        onSuccess: (() => {
            Swal.fire({
                'title': 'Success',
                'text': 'Your feature request has been sent to the developers!',
                'icon': 'success'
            })
        })
    })
}

</script>

<template>
    <Form :form="form" @submit="submit" />
</template>