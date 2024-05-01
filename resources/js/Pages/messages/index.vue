<script setup>
import { ref, onMounted } from "vue";
import axios from 'axios'
import {useForm} from '@inertiajs/vue3'
import Conversation from './conversations.vue'
import Message from './message.vue'
import GroupChat from './group-chat.vue'
const props = defineProps({
    conversations: Object,
    conversation_id: {
        type: Number,
        default: 0
    },
    users: Object
})


const messages = ref()
const is_creating_groupchat = ref(false)
const form = useForm({
    'content': null,
    'conversation_id': props.conversation_id
})
onMounted(() => {
    fetchMessages(props.conversation_id)
    Echo.private(`message-sent`)
    .listen('ChatMessageSent', (e) => {
       messages.value.push(e.message)
    });
})
const fetchMessages = (conversation_id) => {
  
    axios.get('/messages/' + conversation_id)
    .then(response => {
        messages.value = response.data
    })  
}

const sendMessage = () => {
    form.post('/messages',{
        preserveScroll: true,
        onSuccess: () => {
            form.reset('content')
        }
    })
}
</script>

<template>
    <div class="row">
        <div class="col-md-3">
            <Conversation :conversations="conversations" @getMessages="fetchMessages"/>
            <Button label="Create Groupchat" class="btn-block" icon="pi pi-envelope" @click="is_creating_groupchat = true"/>
        </div>
        <div class="col-md-9">
            <Message :messages="messages" :form="form" @sendMessage="sendMessage" />
        </div>
    </div>
    <GroupChat v-model:visible="is_creating_groupchat" @close="is_creating_groupchat = false" :users="users"></GroupChat>
</template>

