<script setup>
    import { router } from "@inertiajs/vue3"
    import { ref, onMounted } from "vue";
    import axios from 'axios'
    const props = defineProps({
        form: Object,
        btnText: String
    })

    const citizens = ref();
   
    const emit = defineEmits(['submit'])
    const cancel = () => {
        router.get('/protocols')
    }

    const fetchCitizens = () => {
        axios.get('/citizens/get-citizens/' + props.form.start_date + '/' + props.form.end_date)
        .then(response => {
            citizens.value = response.data
        })
    }
</script>

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Protocol Details</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="first_name">Protocol Name</label>
                                    <InputText id="first_name" v-model="form.name"  />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="start_date">Start Date</label>
                                    <Calendar dateFormat="dd, M yy" v-model="form.start_date" showIcon iconDisplay="input" inputId="icondisplay" />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="end_date">End Date</label>
                                    <Calendar dateFormat="dd, M yy" v-model="form.end_date" showIcon iconDisplay="input" inputId="icondisplay" @date-select="fetchCitizens"/>
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="citizens">Citizens</label>
                                    <MultiSelect v-model="form.citizens" display="chip" :options="citizens" optionLabel="name" placeholder="Select Citizens" />
                                    <!-- <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div> -->
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
