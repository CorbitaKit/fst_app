<script setup>

    const props = defineProps({
        goals: Array
    })

    const emit = defineEmits(['removeGoal'])

    const getOrdinalText = (number) => {
        const ordinalMap = {
            1: 'First',
            2: 'Second',
            3: 'Third',
            4: 'Fourth',
            5: 'Fifth',
            6: 'Sixth',
            7: 'Seventh',
            8: 'Eighth',
            9: 'Ninth',
            10: 'Tenth'
            
        };
        return ordinalMap[number] || number + 'th';
    }
    const addSubGoal = (goal) => {
        goal.sub_goals.push({
            'name': null,
            'completion_date': null,
            'status': 'Active'
        })
    }

    const removeSubGoal = (goal, index) => {
        goal.sub_goals.splice(index, 1)
    }
</script>
<template>
    <div class="card-body">
        <hr>
        <div v-for="(goal, i) in goals" :key="i" >
            <div class="float-right">
                <a  type="button" @click="$emit('removeGoal', i)" class="text-red">x</a>
            </div>

            <div class="flex flex-column">
                <label for="name">Goal Name</label>
                <InputText id="name"  v-model="goal.name" aria-describedby="name-help" />
            </div>
            <div class="flex flex-column">
                <label for="date">Date Completion</label>
                <Calendar class="mb-2" dateFormat="dd, M yy" v-model="goal.completion_date" showIcon iconDisplay="input" inputId="icondisplay" />
            </div>
            <div style="margin-bottom: 50px;">
                <button @click="addSubGoal(goal)" type="button" class="btn btn-xs btn-primary float-right"><i class="nav-icon fas fa-plus"></i> Add Sub Goal</button>
            </div>
            <div class="card-body">
            <hr>
            <div v-for="(sub_goal, i) in goal.sub_goals" :key="i" >
                <div class="float-right">
                    <a  type="button" @click="removeSubGoal(goal, i)" class="text-red">x</a>
                </div>
                <div class="flex flex-column">
                    <label for="name">Sub Goal Name</label>
                    <InputText id="name"  v-model="sub_goal.name" aria-describedby="name-help" />
                </div>
                <div class="flex flex-column">
                    <label for="date">Date Completion</label>
                    <Calendar class="mb-2" dateFormat="dd, M yy" v-model="sub_goal.completion_date" showIcon iconDisplay="input" inputId="icondisplay" />
                </div>
                <div style="margin-bottom: 20x;">
                    
                </div>
            </div>
        </div>
        </div>
        
    </div>
</template>