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
                            
                            <div class="flex flex-column">
                                <label for="name">Medicine Name</label>
                                <InputText id="name"  v-model="form.name" aria-describedby="name-help" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                            <div class="flex flex-column">
                                <label for="date">Date Given</label>
                                <Calendar dateFormat="dd, M yy" v-model="form.date_given" showIcon iconDisplay="input" inputId="icondisplay" />
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
                <button type="button" @click="submit" class="btn btn-primary">Save and close</button>
                </div>
            </div>
        </div>
    </div>
</template>