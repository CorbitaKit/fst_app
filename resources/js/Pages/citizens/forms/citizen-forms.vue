<script setup>
    import { router } from '@inertiajs/vue3';
    import {ref} from 'vue';
    import { vMaska } from "maska";
    import Calendar from 'primevue/calendar';
    import InputText from 'primevue/inputtext';
    import InputGroup from 'primevue/inputgroup';
    import InputGroupAddon from 'primevue/inputgroupaddon';
    import Dropdown from 'primevue/dropdown';

    const props = defineProps({
        errors: Object,
        regions: Object,
        form: Object,
        btnText: String
    })

    const emit = defineEmits(['submit'])
    
    const municipalities = ref(null)
    const cities = ref(null)

    const getMunicipalities = () => {
        for (let key in props.regions) {
            if (props.regions[key].id == props.form.region_id.id) {
                municipalities.value = props.regions[key].municipalities
            }
        }
    }

    const getCities = () => {
        for (let key in municipalities.value) {
            if (municipalities.value[key].id == props.form.municipality_id.id) {
                cities.value = municipalities.value[key].cities
            }
        }
    }


    const cancel = () => {
        router.get('/citizens')
    }

</script>

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Citizen Details</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="email">Email</label>
                                    <InputText id="email" v-model="form.email" aria-describedby="email-help" :invalid="errors.email" />
                                    <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="first_name">First Name</label>
                                    <InputText id="first_name"  v-model="form.first_name" aria-describedby="first_name-help" :invalid="errors.first_name" />
                                    <div class="text-danger text-xs" v-if="errors.first_name"> {{ errors.first_name }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="last_name">Last Name</label>
                                    <InputText id="last_name"  v-model="form.last_name" aria-describedby="last_name-help" :invalid="errors.last_name" />
                                    <div class="text-danger text-xs" v-if="errors.last_name"> {{ errors.last_name }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="social_security_number">Social Security Number</label>
                                    <InputText v-maska data-maska="######-####" id="social_security_number"  v-model="form.social_security_number" aria-describedby="social_security_number-help" :invalid="errors.social_security_number" />
                                    <div class="text-danger text-xs" v-if="errors.social_security_number"> {{ errors.social_security_number }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="social_security_number">Birth Day</label>
                                    <Calendar dateFormat="dd, M yy" v-model="form.birth_day" showIcon iconDisplay="input" inputId="icondisplay" :invalid="errors.birth_day" />
                                    <div class="text-danger text-xs" v-if="errors.birth_day"> {{ errors.birth_day }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="phone_number">Phone Number</label>
                                    <InputGroup>
                                        <InputGroupAddon>
                                            <span>🇩🇰</span>
                                        </InputGroupAddon>
                                        <InputText v-maska data-maska="+45########" id="phone_number"  v-model="form.phone" aria-describedby="phone-help" :invalid="errors.phone" />
                                        
                                    </InputGroup>
                                    <div class="text-danger text-xs" v-if="errors.phone"> {{ errors.phone }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="address">Address</label>
                                    <InputText id="address"  v-model="form.address" aria-describedby="address-help" :invalid="errors.address" />
                                    <div class="text-danger text-xs" v-if="errors.address"> {{ errors.address }} </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="flex flex-column">
                                    <label for="region">Region</label>
                                    <Dropdown :invalid="errors.region_id" v-model="form.region_id" @change="getMunicipalities" id="region" :options="regions" optionLabel="name" placeholder="Select a Region" filter/>
                                    <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="flex flex-column">
                                    <label for="municipality">Municipality</label>
                                    <Dropdown :invalid="errors.municipality_id" v-model="form.municipality_id" id="municipality" @change="getCities" :options="municipalities" optionLabel="name" placeholder="Select a Municipality" filter/>
                                    <div class="text-danger text-xs" v-if="errors.municipality_id"> {{ errors.municipality_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                
                                <div class="flex flex-column">
                                    <label for="city">City</label>
                                    <Dropdown :invalid="errors.city_id" v-model="form.city_id" id="city" :options="cities" optionLabel="name" placeholder="Select a City" filter/>
                                    <div class="text-danger text-xs" v-if="errors.city_id"> {{ errors.city_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                           
                                <div class="flex flex-column">
                                    <label for="post_code">Post Code</label>
                                    <InputText v-maska data-maska="####" id="post_code" v-model="form.postcode" aria-describedby="postcode-help" :invalid="errors.postcode" />
                                    <div class="text-danger text-xs" v-if="errors.postcode"> {{ errors.postcode }} </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <textarea v-model="form.note" class="form-control" :class="{ 'is-invalid': errors.note }"></textarea>
                                    <div class="text-danger text-xs" v-if="errors.note"> {{ errors.note }} </div>
                                    
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

