<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    const props = defineProps({
        plan_id: Number
    })

    const form = useForm({
        'plan_id': props.plan_id,
        'name': null,
        'completion_date': null,
        'date_completed': null,
        'status': 'Active',
        'sub_goals': []
    })
    const emit = defineEmits(['setActivePage', 'fetchJournal'])

    const goals = ref(null)

    onMounted(() => {
        fetchGoalsOfSelectedPlan()
    })

    const fetchGoalsOfSelectedPlan = () =>{
        axios.get('/plans/get-plan-goals/' + props.plan_id)
        .then((response) => {
            goals.value = response.data
        })
    }

    const submit = () => {
        form.post('/goals', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Goal added successfully!",
                    icon: "success"
                });
                fetchGoalsOfSelectedPlan()
                form.reset()
                emit('fetchJournal')
            }
        })
    }
</script>

<template>
    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-group" >
                        <label for="exampleInputEmail1">Goal Name</label>
                        <input type="text" v-model="form.name" class="form-control"  placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" >
                        <label for="exampleInputEmail1">Completion Date</label>
                        <input v-model="form.completion_date" type="date" class="form-control">
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" @click="$emit('setActivePage')" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
                    <button type="button" @click="submit" class="btn btn-primary">Add Goal</button>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Active Goals for this plan</h4>
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Completion Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(goal, i) in goals" :key="i">
                        <td> {{ goal.name }} </td>
                        <td> {{ goal.completion_date }} </td>
                        <td> {{ goal.status }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</template>