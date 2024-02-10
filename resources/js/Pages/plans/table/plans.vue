<script setup>
    import { ref } from 'vue'
    import Goals from '../table/goals.vue'

    const is_viewing_goals = ref(false)


</script>

<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Plans</h3>
            <div class="card-tools">
                <div class="card-tools">
                <button type="button"  class="btn bg-gradient-default btn-xs">
                    <i class="fas fa-plus"></i>
                    Add new plan
                </button>
                <button type="button" @click="is_viewing_goals = true"  class="btn bg-gradient-default btn-xs">
                    <i class="fas fa-eye"></i>
                    View Goals
                </button>
            </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                       
                        <th>
                            Plan
                        </th>
                        <th>
                            Completion Date
                        </th>
                        <th>
                            Progress
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Date Completed
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a>
                                Plans and goals feature
                            </a>
                            <br/>
                        </td>
                        <td>
                            February 11, 2024
                        </td>
                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                </div>
                            </div>
                            <small>
                                57% Complete
                            </small>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-warning">On Progress</span>
                        </td>
                        <td class="project-state">
                            February 9, 2024
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-success btn-sm" href="#">
                                <i class="fas fa-check">
                                </i>
                                Complete
                            </a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <Goals v-if="is_viewing_goals" />
</template>