<script setup>
import { ref, watch } from "vue"

const props = defineProps({
    conversations: Object
})
const emit = defineEmits(['getMessages'])
const conversation = ref()

watch(conversation, async(newConversation) => {
   
   emit('getMessages', newConversation.id)
})

</script>

<template>
    <div class="card flex justify-content-center">
        <Listbox v-model="conversation" :options="conversations" filter optionLabel="name" class="w-full" listStyle="max-height:250px"/>
    </div>
</template>