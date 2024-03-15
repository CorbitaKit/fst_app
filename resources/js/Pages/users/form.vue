<script setup>
    import { router } from "@inertiajs/vue3"
    import { onMounted, ref } from 'vue'
    import axios from 'axios'
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
                    <h3 class="card-title">User Details</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="name">Name</label>
                                    <InputText id="name" v-model="form.name"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="email">Email</label>
                                    <InputText id="email" v-model="form.email"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="role">Role</label>
                                    <Dropdown  v-model="form.role_id"  id="role" :options="roles" optionLabel="name" placeholder="Select a Role" filter/>
                                    <!-- <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="flex flex-column">
                                    <label for="password">Password</label>
                                    <Password v-model="form.password" id="password" toggleMask />
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
