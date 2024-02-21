<script setup>
    import Marketing from './marketing.vue'
    import Visual from './visual.vue'
    import Other from './other.vue'
    
</script>

<template>
   <div style="padding:10px;">
        <a href="#marketing" type="button" class="btn btn-outline-success btn-sm mr-2">Marketing</a>
        <a href="#visual" type="button" class="btn btn-outline-success btn-sm mr-2">Visual</a>
        <a href="#other" type="button" class="btn btn-outline-success btn-sm">Other</a>
    </div>
    <hr>
    <Marketing />
    <Visual />
    <Other />
</template>

<style>

</style>