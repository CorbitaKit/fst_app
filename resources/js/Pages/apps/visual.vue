<script setup>
    const props = defineProps({
        visuals: Object
    })
</script>

<template>
    <div class="row" id="visual">
        <div class="col-md-3">
            <h5>Visual</h5>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-5" v-for="visual in visuals" :key="visual.id">
                    <Card>
                        <template #title>
                            <div class="flex flex-wrap align-items-center">
                                <Avatar :image="visual.logo" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">{{ visual.name }}</span>
                            </div>
                                
                        </template> 
                        <template #content>
                            <p class="m-0">
                                {{ visual.description }}
                            </p>
                        </template>
                        
                        <template #subtitle>DKK {{ visual.price }} per month</template>
                        <template #footer>
                            <div class="flex mt-1">
                                <Button @click="$emit('seeMore', {'app': visual})" data-toggle="modal" data-target="#modal" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button @click="$emit('activate', { 'price': visual.price })" data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
</template>

