<script setup>
    import ProgressBar from 'primevue/progressbar';
    import { ref } from 'vue';
    import CreateGoal from '../plans/goals/create.vue';
    import CreateSubGoal from './sub-goals/create.vue'
    const props = defineProps({
        data: Object
    })

    const emit = defineEmits(['fetchJournals'])
    const active_page = ref('list')

    const setView = () => {
        active_page.value = 'list'
    }
</script>

<template>
    <div class="modal fade" id="details">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ data.name }} Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" v-if="active_page == 'list'">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Completion Date</th>
                            <th>Completed At</th>
                            <th>Progress Rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ data.name }} </td>
                            <td> {{ data.date_completion }} </td>
                            <td> {{ data.completed_at }} </td>
                            <td>
                                <ProgressBar :value="data.progress ">{{ data.progress }}/100</ProgressBar> 
                            </td>
                            <td> {{ data.status }} </td>
                            <td>
                                <button @click="active_page = 'create_goal'" v-if="data.type == 'plan'" type="button" class="btn btn-sm btn-success mr-1">
                                    <i class="fas fa-plus"></i> Add goals
                                </button>
                                <button @click="active_page = 'create_sub_goal'" v-if="data.type == 'goal'" type="button" class="btn btn-sm btn-success mr-1">
                                    <i class="fas fa-plus"></i> Add sub goals
                                </button>
                                <button type="button" class="btn btn-sm btn-danger mr-1">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <CreateGoal v-if="active_page == 'create_goal'" :plan_id="data.id" @setActivePage="setView" @fetchJournal="$emit('fetchJournals')"/>
                    <CreateSubGoal v-if="active_page == 'create_sub_goal'" :goal_id="data.id" @setActivePage="setView" @fetchJournal="$emit('fetchJournals')"/>
                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>