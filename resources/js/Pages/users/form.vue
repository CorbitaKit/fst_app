<script setup>
    import { router } from "@inertiajs/vue3"
    import { onMounted, ref } from 'vue'
    import axios from 'axios'
    import { vMaska } from "maska";
    const props = defineProps({
        form: Object,
        btnText: String,
        permissions: Object,
        errors: Object
    })
    const roles = ref(null)
    onMounted(() => {
        fetchRoles()
    })
    const emit = defineEmits(['submit'])
    const cancel = () => {
        router.get('/users')
    }

    const fetchRoles = () => {
        axios.get('/roles')
        .then(response => {
            roles.value = response.data
        })
    }
</script>
<style>
    .p-inputtext{
        width: 100%;
    }
</style>
<template>
     <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Employee Details</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="first_name">First Name</label>
                                    <InputText id="first_name" v-model="form.first_name" :invalid="errors.first_name"  />
                                    <div class="text-danger text-xs" v-if="errors.first_name"> {{ errors.first_name[0] }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="last_name">Last Name</label>
                                    <InputText id="last_name" v-model="form.last_name" :invalid="errors.last_name" />
                                    <div class="text-danger text-xs" v-if="errors.last_name"> {{ errors.last_name[0] }} </div>
                                </div>
                            </div>

                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="email">Email</label>
                                    <InputText id="email" v-model="form.email" :invalid="errors.email" />
                                    <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email[0] }} </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="phone">Phone</label>
                                    <InputGroup>
                                        <InputGroupAddon>
                                            <span>🇩🇰</span>
                                        </InputGroupAddon>
                                        <InputText :invalid="errors.phone" v-maska data-maska="+45########" id="phone"  v-model="form.phone" aria-describedby="phone-help" />
                                        
                                    </InputGroup>
                                    <div class="text-danger text-xs" v-if="errors.phone"> {{ errors.phone[0] }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="birthday">Birthday</label>
                                    <Calendar :invalid="errors.birth_day" dateFormat="dd, M yy" v-model="form.birth_day" showIcon iconDisplay="input" inputId="icondisplay" />
                                    <div class="text-danger text-xs" v-if="errors.birth_day"> {{ errors.birth_day[0] }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="address">Address</label>
                                    <InputText id="address" v-model="form.address" :invalid="errors.address" />
                                    <div class="text-danger text-xs" v-if="errors.address"> {{ errors.address }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="role">Role</label>
                                    <Dropdown  v-model="form.role" :invalid="errors.role" id="role" :options="roles" optionLabel="name" placeholder="Select a Role" filter/>
                                    <div class="text-danger text-xs" v-if="errors.role"> {{ errors.role[0] }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="permissions">Permissions</label>
                                    <MultiSelect v-model="form.permissions" :invalid="errors.permissions" display="chip" :options="permissions" optionLabel="name" placeholder="Select Permissions" />
                                    <div class="text-danger text-xs" v-if="errors.permissions"> {{ errors.permissions[0] }} </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" @click="cancel"  class="btn btn-danger mr-1">Cancel</button>
                        <button type="submit" :disabled="form.processing" @click="$emit('submit')" class="btn btn-primary"> {{ btnText }} </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
