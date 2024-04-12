<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        price: Number
    })
    const agree = ref(0)
</script>

<template>
     <div class="modal fade" id="activate_now">
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
                            <img alt="user header" src="/images/activate.jpg" width="100%" height="300"/>
                        </template>
                       
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                                quas!
                            </p>
                            
                        </template>
                        <template #footer>
                            <span>DKK 2999 per month</span>
                            <div class="flex align-items-center">
                                <Checkbox v-model="agree"  inputId="ingredient1" name="agree" value="1" />
                                <label for="ingredient1" class="ml-2 mt-2">
                                    I have read and accept the <a href=" https://awork.dk/vilkaarogbetingelser" target="_blank">terms and conditions</a>
                                </label>
                            </div>
                            <div class="flex gap-3 mt-1">
                                <Button label="I accept, activate now" class="w-full" :disabled="agree != 1"/>
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
</template>