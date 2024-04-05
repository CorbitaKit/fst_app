<script setup>
    import { useForm } from '@inertiajs/vue3';
    import createGoal from '../plan/goal.vue'
    import Swal from 'sweetalert2'
    const props = defineProps({
        citizen_id: Number
    })
    const emit = defineEmits(['fetchPlans', 'cancelAction'])

    const form = useForm({
        'name': null,
        'completion_date': null,
        'citizen_id': props.citizen_id,
        'status': 'Active',
        'goals': [],
    })

    const addGoal = () => {
        form.goals.push({
            'name': null,
            'completion_date': null,
            'status': 'Active',
            'sub_goals': []
        })
    }
    const removeGoal = (index) => {
        form.goals.splice(index ,1)
    }
    

    const submit = () => {
        form.post('/plans', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Plan added successfully!",
                    icon: "success"
                });
                emit('fetchPlans')
            }
        })
    }
    
</script>

<template>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Plan Details</h3>
        </div>
        <form class="form-horizontal">
            <div class="card-body">
                <div class="flex flex-column">
                    <label for="name">Plan Name</label>
                    <InputText id="name"  v-model="form.name" aria-describedby="name-help" />
                </div>
                
                <div class="flex flex-column">
                    <label for="date">Date Completion</label>
                    <Calendar class="mb-2" dateFormat="dd, M yy" v-model="form.completion_date" showIcon iconDisplay="input" inputId="icondisplay" />
                </div>
                <div>
                    <button type="button" class="btn btn-xs btn-primary float-right" @click="addGoal"><i class="nav-icon fas fa-plus"></i> Add Goal</button>
                </div>
                
                <createGoal :goals="form.goals" @removeGoal="removeGoal" />
            </div>

            <div class="card-footer">
                <button type="button" @click="submit" class="btn btn-info float-right mr-2">Create Plan</button>
                <button type="button" @click="$emit('cancelAction')"  class="btn btn-default float-right mr-2">Cancel</button>
            </div>
        </form>
    </div>
</template>