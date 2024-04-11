<script setup>
    const props = defineProps({
        form: Object,
        multiple_days: Boolean
    })
    const emit = defineEmits(['submit', 'cancel'])
</script>

<template>
    <Dialog  modal header="Create Event" :style="{ width: '35rem' }">
        <div class="flex flex-column mb-3">
            <label for="name">Name</label>
            <InputText id="name" v-model="form.title"  aria-describedby="last_name-help"/>
        </div>
        <div class="row">
            
            <div class="col-md-6">
                <label for="start_time">Start Time</label>
                    <InputMask v-model="form.start_time" mask="99:99" max="24" placeholder="00:00"/>
            </div>
            <div class="col-md-6">
                <div class="flex flex-column">
                    <label for="start_time">End Time</label>
                    <InputMask v-model="form.end_time" mask="99:99" max="24" placeholder="00:00"/>
                </div>
            </div>
       </div>
       <div class="mb-8" v-if="multiple_days">
            <Button label="Set different time for each date" class="mt-2 float-right" severity="info" text raised />
       </div>
       
        <div class="flex justify-content-end mt-3">
            <Button type="button" label="Cancel" severity="secondary" @click="$emit('cancel')"></Button>
            <Button type="button" label="Save" @click="$emit('submit')"></Button>
        </div>
    </Dialog>
</template>