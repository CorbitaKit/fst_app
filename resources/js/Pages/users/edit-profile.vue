<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { vMaska } from "maska";
import Swal from "sweetalert2";
const props = defineProps({
    user: Object
})

const form = useForm(props.user.employee)

const updateProfile = () => {
    form.patch('/employees/' + form.id, {
        onSuccess: () => {
            Swal.fire({
                'title': 'Success',
                'text': 'Profile updated Successfully!',
                'icon': 'success'
            })

            router.get('/users/' + props.user.id)
        }
    })
}
</script>

<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="https://via.placeholder.com/64"
                        alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ user.name }} </h3>
                    <div class="text-center">
                        <span>{{ user.employee.address }}</span>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ user.email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="float-right">{{ user.employee.phone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
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
                                    <InputText disabled id="email" v-model="form.email"  />
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
                            
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" @click="updateProfile" class="btn btn-primary"> Update Profile </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>