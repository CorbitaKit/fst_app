<script setup>
import { onMounted, ref } from 'vue'
import { getUserPlugin } from '../plugins/get-user'

const { getUser } = getUserPlugin()
const props = defineProps({
    messages: Object,
    form: Object,
})

const user = ref()
onMounted(() => {
    user.value = getUser()
})
const checkSender = (sender_id) => {
   
   return sender_id === user.value.value.id ? 'sent' : 'received';
}
</script>

<template>
     <Card>
        <template #content>
            <div class="message-container">
                <div v-for="(message, index) in messages" :key="index" :class="['message', checkSender(message.user_id)]">
                    <div class="message-header">
                        <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" size="small" shape="circle" />
                        {{ message.user.name }}
                        
                    </div>
                    <div class="message-content mt-3">{{ message.content }}</div>
                </div>
                <div class="message-input">
                <input type="text" v-model="form.content" @keyup.enter="$emit('sendMessage')" placeholder="Type your message here..." />
                <button @click="$emit('sendMessage')">Send</button>
                </div>
            </div>
        </template>
        
    </Card>
</template>

<style scoped>
    .message-container {
    display: flex;
    flex-direction: column;
    }

    .message {
    margin: 10px;
    padding: 5px 10px;
    border-radius: 5px;
    max-width: 70%;
    }

    .sent {
    align-self: flex-end;
    background-color: #c6dff8;
    }

    .received {
    align-self: flex-start;
    background-color: #F0F0F0;
    }

    .message-input {
    display: flex;
    margin-top: auto;
    padding: 10px;
    background-color: #F0F0F0;
    }

    .message-input input {
    flex: 1;
    margin-right: 10px;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    }

    .message-input button {
    padding: 5px 10px;
    border-radius: 5px;
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    }

    .message-input button:hover {
    background-color: #0056b3;
    }
</style>