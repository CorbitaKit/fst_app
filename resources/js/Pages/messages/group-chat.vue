<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    users: Object
})

const emit = defineEmits(['close'])
const form = useForm({
    name: null,
    users: []
})

const createGroupChat = () => {
    form.post('/messages/group-chat')
}
</script>

<template>
    <Dialog modal header="Conversation Details" :style="{ width: '30rem' }">
        <div class="flex flex-column">
            <label for="name">Conversation Name</label>
            <InputText id="name"  v-model="form.name" aria-describedby="name-help" />
        </div>
        <div class="flex flex-column mb-3">
            <label for="name">Participants</label>
            <MultiSelect v-model="form.users"  display="chip" :options="users" optionLabel="name" placeholder="Select Participants" />
        </div>
      
        <div class="flex justify-content-end gap-2">
            <Button type="button" label="Cancel" severity="secondary" @click="emit('close')"></Button>
            <Button type="button" label="Save" @click="is_creating_groupchat = false"></Button>
        </div>
    </Dialog>
</template>