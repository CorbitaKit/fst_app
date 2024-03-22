<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
const form = useForm({
    'password': null,
    'password_confirmation': null
})

const is_matched = ref(true)

const checkIfPasswordMatch = () => {
    if (form.password != form.password_confirmation) {
        is_matched.value = false
        return
    } 
    is_matched.value = true
}
const submit = () => {
    form.patch('/users/password-change', {
        onSuccess: () => {
            router.get('/home')
        }
    })
}
</script>

<template>
     <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Password Change</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="first_name">Password</label>
                                    <Password v-model="form.password" toggleMask />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="last_name">Confirm Password</label>
                                    <Password :feedback="false"  v-model="form.password_confirmation" toggleMask @input="checkIfPasswordMatch"/>
                                    <div class="text-danger text-xs" v-if="! is_matched"> Password does not match </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                       
                        <button :disabled="! is_matched" type="submit" @click="submit" class="btn btn-primary"> Update Password </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>