<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    protocols: Object
})
const selectedUser = ref();
const menu = ref();
const items = ref([

    {
        label: 'Remove',
        icon: 'pi pi-trash',
    },
    {
        label: 'Mark as absent',
        icon: 'pi pi-ban',
    }
]);        

const onRightClick = (event, user, protocol) => {
    console.log(protocol)
    selectedUser.value = user;
    menu.value.show(event);
};



const addNewProtocol = () => {
    router.get('/protocols/create')
}

const getTodaysDate = () => {
    const date = new Date('2024-03-22');
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    const formattedDate = date.toLocaleDateString('da-DK', options);

    return formattedDate
}
</script>

<template>
    <div class="flex flex-wrap align-items-center justify-content-between gap-2">
        <span class="text-xl text-900 font-bold">Protocol List</span>
        <Button label="Add new Protocol" @click="addNewProtocol"  icon="pi pi-plus" class="float-right" raised />
    </div>
    <div class="row">
        <div class="col-md-4" v-for="(protocol, i) in protocols" :key="i">
            <div class="card">
                <div class="flex flex-wrap align-items-center justify-content-between gap-2 p-2">
                    
                    <span class="text-md text-900 font-bold">{{ getTodaysDate() }}</span>
                    
                </div>
                <ul class="m-2 p-2 list-none surface-border border-round flex flex-column md:w-22rem">
                    <li
                        v-for="user in protocol.citizens"
                        :key="user.id"
                        :class="['p-2 hover:surface-hover border-round border-1 border-transparent transition-all transition-duration-200 flex align-items-center justify-content-between', { 'border-primary': selectedUser?.id === user.id }]"
                        @contextmenu="onRightClick($event, user, protocol)"
                    >
                        <div class="flex align-items-center gap-2">
                            <img :alt="user.first_name" :src="`https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png`" style="width: 32px" />
                            <span class="font-bold">{{ user.name }} {{ user.last_name }}</span>
                        </div>
                        <Tag value="Member" severity="info" />
                    </li>
                </ul>
                
            </div>
        </div>
        <ContextMenu ref="menu" :model="items"/>
    </div>
    

        
</template>