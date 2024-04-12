<script setup>
    const props = defineProps({
        marketings: Object
    })
</script>

<template>
    <div class="row" id="marketing">
        <div class="col-md-3">
            <h5>Marketing</h5>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-5" v-for="marketing in marketings" :key="marketing.id">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar :image="marketing.logo" class="mr-2" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">{{ marketing.name }}</span>
                            </div>
                                
                        </template> 
                        <template #content>
                            <p class="m-0">
                                {{ marketing.description }}
                            </p>
                        </template>
                        
                        <template #subtitle>DKK {{ marketing.price }} per month</template>
                        <template #footer>
                            <div class="flex mt-1">
                                <Button @click="$emit('seeMore', { 'app': marketing })" data-toggle="modal" data-target="#modal" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button @click="$emit('activate', { 'price': marketing.price })" data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
   
</template>