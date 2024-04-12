<script setup>
    const props = defineProps({
        app: Object,
    })

</script>

<template>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <Card>
                        <template #header>
                            <img alt="user header" :src="app.image" width="100%" height="300"/>
                        </template> 
                       
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                                quas!
                            </p>
                        </template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <a type="button" href="https://findsocialetilbud.dk/kontakt-findsocialetilbud-dk" target="_blank" class="btn btn-default w-full" label="Contact Us" severity="secondary" outlined >Contact Us</a>
                                <Button @click="$emit('activate', { 'price': app.price })" data-toggle="modal" data-dismiss="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
</template>