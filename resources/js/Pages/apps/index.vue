<script setup>
    import Marketing from './marketing.vue'
    import Visual from './visual.vue'
    import Other from './other.vue'
    import Activate from './modals/activate.vue'
    import Modal from './modals/see_more.vue'
    import { ref } from 'vue'
    const props = defineProps({
        apps: Object
    })

    const app = ref()
    const price = ref()
    const seeMore = (app_data) => {
        app.value = app_data.app
    }

    const activate = (price_data) => {
        price.value = price_data.price
    }

    
</script>

<template>
   <div style="padding:10px;">
        <a href="#marketing" type="button" class="btn btn-outline-success btn-sm mr-2">Marketing</a>
        <a href="#visual" type="button" class="btn btn-outline-success btn-sm mr-2">Visual</a>
        <a href="#other" type="button" class="btn btn-outline-success btn-sm">Other</a>
    </div>
    <hr>
    <Activate :price="price"/>
    <Marketing :marketings="apps.Marketing" @seeMore="seeMore" @activate="activate"/>
    <Visual :visuals="apps.Visual" @seeMore="seeMore"  @activate="activate"/>
    <Other :others="apps.Other" @seeMore="seeMore"  @activate="activate"/>

    <Modal :app="app" @activate="activate"/>

   

</template>

<style>

</style>