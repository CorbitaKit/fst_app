<script setup>
const props = defineProps({
    features: Object
})
</script>

<template>
    <div class="row">
        <div class="col-md-3">
            <Card v-for="feature in features" :key="feature.id">
                <template #title>{{ feature.name }}</template>
                <template #content>
                    <p class="m-0" v-html="feature.description">
                       
                    </p>
                </template>
            </Card>
        </div>
    </div>
</template>