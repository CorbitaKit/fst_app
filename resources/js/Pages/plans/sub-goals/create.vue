<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    const props = defineProps({
        goal_id: Number
    })

    const form = useForm({
        'goal_id': props.goal_id,
        'name': null,
        'completion_date': null,
        'date_completed': null,
        'status': 'Active',
    })
    const emit = defineEmits(['setActivePage', 'fetchJournal'])

    const sub_goals = ref(null)

    onMounted(() => {
        featchSubGoalOfSelectedGoal()
    })

    const featchSubGoalOfSelectedGoal = () =>{
        axios.get('/goals/get-sub-goals/' + props.goal_id)
        .then((response) => {
            sub_goals.value = response.data
        })
    }

    const submit = () => {
        form.post('/sub_goals', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Goal added successfully!",
                    icon: "success"
                });
                featchSubGoalOfSelectedGoal()
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
                    <div class="flex flex-column">
                <label for="name"> Name</label>
                <InputText id="name"  v-model="form.name" aria-describedby="name-help" />
            </div>
                </div>
                <div class="col-md-12">
                    <div class="flex flex-column">
                        <label for="date">Date Completion</label>
                        <Calendar class="mb-2" dateFormat="dd, M yy" v-model="form.completion_date" showIcon iconDisplay="input" inputId="icondisplay" />
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" @click="$emit('setActivePage')" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
                    <button type="button" @click="submit" class="btn btn-primary">Add Sub Goal</button>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Active Sub goals for this goal</h4>
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Completion Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(sub_goal, i) in sub_goals" :key="i">
                        <td> {{ sub_goal.name }} </td>
                        <td> {{ sub_goal.completion_date }} </td>
                        <td> {{ sub_goal.status }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</template>