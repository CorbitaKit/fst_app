<script setup>
    import { router } from '@inertiajs/vue3';
    import {ref} from 'vue';

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
            if (props.regions[key].id == props.form.region_id) {
                municipalities.value = props.regions[key].municipalities
            }
        }
    }

    const getCities = () => {
        for (let key in municipalities.value) {
            if (municipalities.value[key].id == props.form.municipality_id) {
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
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" v-model="form.email"  class="form-control" :class="{ 'is-invalid': errors.email }" placeholder="Enter email">
                                    <div class="text-danger text-xs" v-if="errors.email"> {{ errors.email }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" v-model="form.first_name" class="form-control" :class="{ 'is-invalid': errors.first_name }" placeholder="Enter First Name">
                                    <div class="text-danger text-xs" v-if="errors.first_name"> {{ errors.first_name }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" v-model="form.last_name" class="form-control" :class="{ 'is-invalid': errors.last_name }" placeholder="Enter Last Name">
                                    <div class="text-danger text-xs" v-if="errors.last_name"> {{ errors.last_name }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Social Security Number</label>
                                    <input type="text" v-model="form.social_security_number" class="form-control" :class="{ 'is-invalid': errors.social_security_number }" placeholder="Enter Social Security Number">
                                    <div class="text-danger text-xs" v-if="errors.social_security_number"> {{ errors.social_security_number }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date of Birth</label>
                                    <input type="date" v-model="form.birth_day" class="form-control" :class="{ 'is-invalid': errors.birth_day }">
                                    <div class="text-danger text-xs" v-if="errors.birth_day"> {{ errors.birth_day }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number</label>
                                    <input type="text" v-model="form.phone" class="form-control" :class="{ 'is-invalid': errors.phone }" placeholder="Enter Phone Number">
                                    <div class="text-danger text-xs" v-if="errors.phone"> {{ errors.phone }} </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" v-model="form.address" class="form-control" :class="{ 'is-invalid': errors.address }" placeholder="Enter Address">
                                    <div class="text-danger text-xs" v-if="errors.address"> {{ errors.address }} </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Region</label>
                                    <select class="form-control" :class="{ 'is-invalid': errors.region_id }" @change="getMunicipalities" v-model="form.region_id">
                                        <option v-for="(region, i) in regions" :key="i" :value="region.id">
                                            {{ region.name }}
                                        </option>
                                    </select>
                                    <div class="text-danger text-xs" v-if="errors.region_id"> {{ errors.region_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Municipalities</label>
                                    <select class="form-control" :class="{ 'is-invalid': errors.municipality_id }"  v-model="form.municipality_id" @change="getCities">
                                        <option v-for="(municipality, i) in municipalities" :key="i" :value="municipality.id">
                                            {{ municipality.name }}
                                        </option>
                                    </select>
                                    <div class="text-danger text-xs" v-if="errors.municipality_id"> {{ errors.municipality_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">City</label>
                                    <select class="form-control" :class="{ 'is-invalid': errors.city_id }"  v-model="form.city_id">
                                        <option v-for="(city, i) in cities" :key="i" :value="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                    <div class="text-danger text-xs" v-if="errors.city_id"> {{ errors.city_id }} </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Code</label>
                                    <input type="text" v-model="form.postcode" class="form-control" :class="{ 'is-invalid': errors.postcode }" placeholder="Enter Post Code">
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