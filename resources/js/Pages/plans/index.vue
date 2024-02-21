<script setup>
    import TreeTable from 'primevue/treetable';
    import Button from 'primevue/button';
    import Column from 'primevue/column';
    import { ref, onMounted } from 'vue';
    import Details from '../plans/details.vue';
    import Swal from 'sweetalert2';
    import ProgressBar from 'primevue/progressbar';
    import axios from 'axios';
    import CreatePlan from '../plans/plan/create.vue';
    const props = defineProps({
        citizen_id: Number
    })

    const nodes = ref(null)
    const data = ref(null)
    const route = ref(null)
    const plans = ref(null)
    const value = ref(parseInt(10))
    const is_creating = ref(false)
    onMounted(() => {
        fetchPlansAndGoals()
    })

    const fetchPlansAndGoals = () => {
        is_creating.value = false
        axios.get('/plans/get-citizen-plans-and-goals/' + props.citizen_id)
        .then((response) => {
            plans.value = response.data
            setData()
        })
    }

    const setData = () => {

        const child_node = [];
        plans.value.forEach((plan) => {
            child_node.push({
                'key': plan.id,
                'data': {
                    'id': plan.id,
                    'name': plan.name,
                    'date_completion': plan.completion_date,
                    'progress': getCompletionRate(plan.goals),
                    'status': plan.status,
                    'completed_at': plan.date_completed,
                    'type': 'plan'
                },
                'children': getGoals(plan.goals)
            })
        })
        nodes.value = child_node
    }

    const getGoals = (goals) => {
        const goal_node = [];
        goals.forEach((goal) => {
            goal_node.push({
                'key': goal.plan_id + '-' + goal.id,
                'data': {
                    'id': goal.id,
                    'name': goal.name,
                    'date_completion': goal.completion_date,
                    'progress': getCompletionRate(goal.sub_goals),
                    'status': goal.status,
                    'completed_at': goal.date_completed,
                    'type': 'goal'
                },
                'children': getSubGoals(goal.sub_goals, goal.plan_id)
            })
        })
        return goal_node
    }


    const getSubGoals = (sub_goals, plan_id) => {
        const sub_goal_node = [];
        sub_goals.forEach((sub_goal) => {
            sub_goal_node.push({
                'key': plan_id + '-' + sub_goal.goal_id + '-' + sub_goal.id,
                'data': {
                    'id': sub_goal.id,
                    'name': sub_goal.name,
                    'date_completion': sub_goal.completion_date,
                    'progress': sub_goal.status == 'Active' ? 0 : 100,
                    'status': sub_goal.status,
                    'completed_at': sub_goal.date_completed,
                    'type': 'sub goal'
                }
            })
        })
        return sub_goal_node
    }

    const getCompletionRate = (nodes) => {
        const completed = ref(null);
        nodes.forEach((node) => {
            if (node.status == 'complete') {
                completed.value += 1
            }
        })
        if (completed.value > 0) {
            return parseInt(((completed.value / nodes.length) * 100).toFixed(2));
        }

        return parseInt(0)
    }

    const getSelectedNode = (node) => {
       data.value = node.node.data
    }

    const markAsComplete = (node) => {
        getRoute(node)
        if (node.progress < 100) {
            Swal.fire({
                title: "Are you sure?",
                text: "This " + node.type + " is not 100% complete yet",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, complete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.patch(route.value)
                    .then(() => {
                        
                        fetchPlansAndGoals()
                    })
                }
            });
        }
    }

    const getRoute = (node) => {
        if (node.type == 'plan') {
            route.value = '/plans/mark-as-complete/' + node.id
        } else if (node.type == 'goal') {
            route.value = '/goals/mark-as-complete/' + node.id
        } else {
            route.value = '/sub_goals/mark-as-complete/' + node.id
        }
        return route
    }

</script>


<template>
    <div class="tab-pane" id="plansAndGoals">
        <div class="card" v-if="!is_creating">
            <TreeTable :value="nodes" class="`p-treetable-sm">
                <template #header>
                    <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                        <span class="text-xl text-900 font-bold">Plan List</span>
                        <Button label="Add new plan" @click="is_creating = true" icon="pi pi-plus" class="float-right" raised />
                    </div>
                </template>
                <Column field="name" header="Name" expander headerStyle="width: 20rem"></Column>
                <Column field="progress" header="Progress Rate" >
                    
                    <template #body="node">
                        
                            <ProgressBar :value="node.node.data.progress">{{ node.node.data.progress }}/100</ProgressBar> 
                   
                    </template>
                    
                </Column>
                <Column field="status" header="Status"></Column>
                <Column headerStyle="width: 10rem">
                    <template #body="node">
                        <div class="flex flex-wrap">
                            <Button class="mr-2" @click="getSelectedNode(node)" data-toggle="modal"  data-target="#details" v-tooltip.bottom="'View Details'" icon="pi pi-eye" rounded severity="info" raised />
                            <Button type="button" :disabled="node.node.data.status == 'complete'" @click="markAsComplete(node.node.data)" v-tooltip.bottom="'Mark as complete'" icon="pi pi-check" rounded severity="success" raised />
                        </div>
                    </template>
                </Column>
            </TreeTable>
        </div>
        <Details :data="data" v-if="data" @fetchJournals="fetchPlansAndGoals"/>
        <CreatePlan v-if="is_creating" @fetchPlans="fetchPlansAndGoals" @cancelAction="is_creating = false" :citizen_id="citizen_id"/>
    </div>
    
</template>