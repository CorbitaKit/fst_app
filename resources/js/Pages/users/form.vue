<script setup>
    import { router } from "@inertiajs/vue3"
    import { onMounted, ref } from 'vue'
    import axios from 'axios'
    import { vMaska } from "maska";
    const props = defineProps({
        form: Object,
        btnText: String
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
                                    <InputText id="first_name" v-model="form.first_name"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="last_name">Last Name</label>
                                    <InputText id="last_name" v-model="form.last_name"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>

                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="email">Email</label>
                                    <InputText id="email" v-model="form.email"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="phone">Phone</label>
                                    <InputGroup>
                                        <InputGroupAddon>
                                            <span>🇩🇰</span>
                                        </InputGroupAddon>
                                        <InputText v-maska data-maska="+45########" id="phone"  v-model="form.phone" aria-describedby="phone-help" />
                                        
                                    </InputGroup>
                                    <!-- <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="birthday">Birthday</label>
                                    <Calendar dateFormat="dd, M yy" v-model="form.birth_day" showIcon iconDisplay="input" inputId="icondisplay" />
                                    <!-- <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="address">Address</label>
                                    <InputText id="address" v-model="form.address"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="role">Role</label>
                                    <Dropdown  v-model="form.role"  id="role" :options="roles" optionLabel="name" placeholder="Select a Role" filter/>
                                    <!-- <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div> -->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" @click="cancel"  class="btn btn-danger mr-1">Cancel</button>
                        <button type="submit" @click="$emit('submit')" class="btn btn-primary"> {{ btnText }} </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
