<script setup>
    import { ref } from 'vue'
    const props = defineProps({
        form: Object
    })

    const dates = ref([])
    const set_time = ref(false)
    const emit = defineEmits(['submit', 'cancel'])

    const checkForMultipleDays = (start, end) => {
        const oneDayInMillis = 24 * 60 * 60 * 1000;
        const diff = Math.abs(start.getTime() - end.getTime());
        return diff === oneDayInMillis;
    }

    const getAllDates = () => {
        let current_date = new Date(props.form.start)
        dates.value = []
        while (current_date < new Date(props.form.end)) {
            dates.value.push(new Date(current_date));
            props.form.dates.push({
                'start_time': '',
                'end_time': '',
                'start': current_date,
                'end': current_date
            })
            current_date.setDate(current_date.getDate() + 1);
            
        }
        set_time.value = true
    }

    const formatDate = (date_format) => {
        
        const date = new Date(date_format);
        const options = {day: 'numeric', 
            month: 'long', 
            year: 'numeric',
          
        };
        const formattedDate = date.toLocaleDateString('da-DK', options);
        return formattedDate
    }
</script>

<template>
    <Dialog  modal header="Create Event" :style="{ width: '35rem' }">
        <div class="flex flex-column mb-3">
            <label for="name">Name</label>
            <InputText id="name" v-model="form.title"  aria-describedby="last_name-help"/>
        </div>
        <div class="row" v-if="! set_time">
            
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
       <div class="row mb-2" v-else v-for="(date, i) in dates" :key="i">
            <div class="col-md-12">
                <label for="start_time">Date: {{ formatDate(date) }}</label>
                    
            </div>
            <div class="col-md-6">
                <label for="start_time">Start Time</label>
                    <InputMask v-model="form.dates[i].start_time" mask="99:99" max="24" placeholder="00:00"/>
            </div>
            <div class="col-md-6">
                <div class="flex flex-column">
                    <label for="start_time">End Time</label>
                    <InputMask v-model="form.dates[i].end_time" mask="99:99" max="24" placeholder="00:00"/>
                </div>
            </div>
       </div>
       <div class="mb-8" v-if="! checkForMultipleDays(new Date(form.start), new Date(form.end)) && form.type == 'schedule'">
            <Button @click="getAllDates" label="Set different time for each date" class="mt-2 float-right" severity="info" text raised />
       </div>
       
        <div class="flex justify-content-end mt-3">
            <Button type="button" label="Cancel" severity="secondary" @click="$emit('cancel')"></Button>
            <Button type="button" label="Save" @click="$emit('submit')"></Button>
        </div>
    </Dialog>
</template>