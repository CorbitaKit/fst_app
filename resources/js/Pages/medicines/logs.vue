<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios';

const logs = ref()
const props = defineProps({
    medicine_id: Number
})

const fetchMedicineLogs = () => {
    axios.get('/logs/medicine/' + props.medicine_id)
    .then(response => {
        logs.value = response.data
    })
}
const formatDate = (date, format) => {
    moment.locale('da')
    return moment(date).format(format);
}
</script>

<template>
    <div class="modal fade" id="modal-logs">
        <div class="modal-dialog">
            <div class="modal-content">
                <Timeline :value="logs"  align="alternate" class="mt-5 mb-5" v-if="!list_view">
                    <template #marker="slotProps">
                        <span class="flex w-2rem h-2rem align-items-center justify-content-center text-white border-circle z-1 shadow-1" :style="{ backgroundColor: slotProps.item.color }">
                            <i :class="slotProps.item.icon"></i>
                        </span>
                    </template>
                    <template #content="slotProps">
                        <Card class="mt-3">
                            <template #title>
                                {{ slotProps.item.status }}
                            </template>
                            <template #subtitle>
                                {{ formatDate(slotProps.item.created_at, "D. MMMM YYYY HH:mm")}}
                            </template>
                            <template #content>
                                <p>
                                    {{ slotProps.item.user.name }} {{slotProps.item.action}}
                                </p>
                            </template>
                        </Card>
                    </template>
                </Timeline>
            </div>
        </div>
    </div>
</template>