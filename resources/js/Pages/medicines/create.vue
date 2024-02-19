<script setup>

    import { ref } from 'vue'
    const props = defineProps({
        citizen_id: Number,
        form: Object
    })
    const emit = defineEmits(['fetchMedicineJournal', 'submit'])
    const closeButton = ref(null);

    const submit = () => {
        closeButton.value.click();
        emit('submit')
    }


</script>
<template>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Medicine Details</h4>
                <button type="button" ref="closeButton" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Medicine Name</label>
                                <input type="text" class="form-control" v-model="form.name"  placeholder="Enter medicine" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Date Given</label>
                                <input type="date" v-model="form.date_given" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Reason</label>
                                <textarea class="form-control" v-model="form.description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" @click="submit" class="btn btn-primary">Save and cloe</button>
                </div>
            </div>
        </div>
    </div>
</template>