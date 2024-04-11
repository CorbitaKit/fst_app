<script setup>
   const props = defineProps({
    others: Object
   })
</script>

<template>
    <div class="row" id="other">
        <div class="col-md-3">
            <h5>Other</h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4 mb-5" v-for="other in others" :key="other.id">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar :image="other.logo" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">{{ other.name }}</span>
                            </div> 
                        </template> 
                        <template #content>
                            <p class="m-0">
                               {{ other.description }}
                            </p>
                        </template>
                        
                        <template #subtitle>DKK {{ other.price }} per month</template>
                        <template #footer>
                            <div class="flex mt-1">
                                <Button @click="$emit('seeMore', { 'app': other })" data-toggle="modal" data-target="#modal" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button @click="$emit('activate', { 'price': other.price })" data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />

                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
</template>