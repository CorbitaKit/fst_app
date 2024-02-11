<script setup>
    import TreeTable from 'primevue/treetable';
    import Button from 'primevue/button';
    import Column from 'primevue/column';
    import { ref, onMounted } from 'vue';
    import Details from '../plans/details.vue'
    const props = defineProps({
        plans: Object
    })

    const node = ref(null)

    onMounted(() => {
        const child_node = [];
        props.plans.forEach((plan) => {
            child_node.push({
                'key': plan.id,
                'data': {
                    'name': plan.name,
                    'date_completion': plan.completion_date,
                    'progress': '100%',
                    'status': plan.status,
                    'completed_at': plan.date_completed
                },
                'children': getGoals(plan.goals)
            })
        })
        node.value = child_node
    })

    const getGoals = (goals) => {
        const goal_node = [];
        goals.forEach((goal) => {
            goal_node.push({
                'key': goal.plan_id + '-' + goal.id,
                'data': {
                    'name': goal.name,
                    'date_completion': goal.completion_date,
                    'progress': '100%',
                    'status': goal.status,
                    'completed_at': goal.date_completed
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
                    'name': sub_goal.name,
                    'date_completion': sub_goal.completion_date,
                    'progress': '100%',
                    'status': sub_goal.status,
                    'completed_at': sub_goal.date_completed
                }
            })
        })
        return sub_goal_node
    }

    function test(data) {
       console.log(data)
    }
</script>


<template>
    <div class="tab-pane" id="plansAndGoals">
        <div class="card">
            <TreeTable :value="node" class="`p-treetable-sm">
                <template #header>
                    <div class="text-xl font-bold">Plans and Goals</div>
                </template>
                <Column field="name" header="Name" expander></Column>
                <Column field="status" header="Status"></Column>
                <Column headerStyle="width: 10rem">
                    <template #body>
                        <div class="flex flex-wrap">
                            <Button class="mr-2" data-toggle="modal"  data-target="#details" v-tooltip.bottom="'View Details'" icon="pi pi-eye" rounded severity="info" raised />
                            <Button type="button" v-tooltip.bottom="'Mark as complete'" icon="pi pi-check" rounded severity="success" raised />
                        </div>
                    </template>
                </Column>
            </TreeTable>
        </div>
    </div>
    <Details />
</template>