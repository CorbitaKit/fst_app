<script setup>
    import JounalTab from '../journals/index.vue';
    import MedJournal from '../medicines/index.vue';
    import PlansAndGoals from '../plans/index.vue'
    import { ref } from 'vue'
    const props = defineProps({
        citizen: Object
    })

    const active_tab = ref('journal')

    
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
                    <h3 class="profile-username text-center">{{ citizen.first_name }} {{ citizen.last_name }}</h3>
                    <div class="text-center">
                        <!-- <span>{{ citizen.address.address }}</span> -->
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ citizen.email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="float-right">{{ citizen.phone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a @click="active_tab = 'journal'" class="nav-link active" href="#journal" data-toggle="tab">Journal</a></li>
                        <li class="nav-item"><a @click="active_tab = 'medicine_journal'" class="nav-link" href="#medJournal" data-toggle="tab">Midicine Journal</a></li>
                        <li class="nav-item"><a @click="active_tab = 'plans_and_goals'" class="nav-link" href="#plansAndGoals" data-toggle="tab">Plans And Goals</a></li>
                        <li class="nav-item"><a class="nav-link" href="#notifications" data-toggle="tab">Documents</a></li>
                        <li class="nav-item"><a class="nav-link" href="#notifications" data-toggle="tab">Notifications</a></li>
                        <li class="nav-item"><a class="nav-link" href="#appointments" data-toggle="tab">Appointments</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <JounalTab v-if="active_tab == 'journal'" :citizen_id="citizen.id"/>
                        <MedJournal v-if="active_tab == 'medicine_journal'" :citizen_id="citizen.id"/>
                        <PlansAndGoals v-if="active_tab == 'plans_and_goals'" :citizen_id="citizen.id"/>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
