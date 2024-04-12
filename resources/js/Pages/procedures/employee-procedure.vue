<script setup>
    
    const props = defineProps({
        employees: Object
    })


</script>

<template>
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" >
                    <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Progress</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td>
                                {{ employee.first_name }} {{ employee.last_name }}
                            </td>
                            <td >
                                <ProgressBar :value="employee.completion_rate"></ProgressBar>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>