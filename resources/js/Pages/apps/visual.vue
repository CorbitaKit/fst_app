<script setup>
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';
</script>

<template>
    <div class="row">
        <div class="col-md-3">
            <h5>Visual</h5>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex flex-wrap align-items-center">
                                <Avatar image="/images/photograph.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Foto and video</span>
                            </div>
                                
                        </template> 
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                quas!
                            </p>
                        </template>
                        
                        <template #subtitle>DKK 2999 per month</template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/web.png" class="mr-2" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">Website</span>
                            </div>
                                
                        </template> 
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                quas!
                            </p>
                        </template>
                        <template #subtitle>DKK 2999 per month</template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/packaging.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Brand Package</span>
                            </div>
                                
                        </template> 
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                quas!
                            </p>
                        </template>
                        <template #subtitle>DKK 2999 per month</template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
               
            </div>
        </div>
        
       
    </div>
    <hr>
</template>