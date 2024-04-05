<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
    citizen_id: Number
})
const protocols = ref()

onMounted(() => {
    axios.get('/protocols/get-citizen-protocols/' + props.citizen_id)
    .then(response => {
        protocols.value = response.data
    })
})
</script>

<template>
    <div>
        <Accordion :activeIndex="0">
            <AccordionTab v-for="protocol in protocols" :key="protocol.id" :header="protocol.name">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" >
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Citizen</th>
                            <th>Status</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="citizen in protocol.citizens" :key="citizen.id">
                            <td> {{ citizen.pivot.date }} </td>
                            <td> {{ citizen.first_name}} {{ citizen.last_name }} </td>
                            <td> {{ citizen.pivot.status }} </td>

                        
                        </tr>
                        </tbody>
                    </table>
                </div>
            </AccordionTab>
        </Accordion>
    </div>
</template>