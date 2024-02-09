<script setup>
    import journalBtns from '../journals/buttons.vue'
    import journalCreation from '../journals/create.vue'
    import { ref } from 'vue'
    import moment from 'moment';

    const props = defineProps({
        journals: Object,
        citizen_id: Number
    })
    const is_creating = ref(false)


    const formatDate = (date) => {
        return moment(date).format('MMMM D, YYYY hh:mm A');
    }

    const createJournal = () => {
        is_creating.value = true
    }
</script>

<template>
    <div class="active tab-pane" id="journal">
        <div v-if="! is_creating">
            <div class="row mb-5">
                <div class="col-md-6">
                    <button type="button" @click.prevent="createJournal" class="btn bg-gradient-success mb-2 mr-2">
                        <i class="fas fa-plus"></i>
                        Add new journal
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <select class="form-control">
                                    <option>Sort Newest First</option>
                                    <option>Sort Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <input type="email" class="form-control" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post" v-for="(journal, i) in journals" :key="i">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="https://via.placeholder.com/32" alt="user image">
                    <span class="username">
                        Created By <a href="#">Jonathan Burke Jr.</a>
                    <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                    </span>
                    <span class="description">Created at {{ formatDate(journal.created_at) }}</span>
                </div>
                <p v-html="journal.content"></p>
                <div class="text-right">
                    <p>
                        <journalBtns :journal="journal" />
                    </p>
                </div>
            </div>
        </div>
        <journalCreation v-else @cancelAction="is_creating = false" :citizen_id="citizen_id"/>
        
    </div>
</template>