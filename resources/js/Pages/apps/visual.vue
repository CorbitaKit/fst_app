<script setup>
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';
</script>

<template>
    <div class="row" id="visual">
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
                            <div class="flex mt-1">
                                <Button data-toggle="modal" data-target="#photovideo" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
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
                            <div class="flex mt-1">
                                <Button data-toggle="modal" data-target="#website" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
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
                            <div class="flex mt-1">
                                <Button data-toggle="modal" data-target="#brand" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="modal fade" id="photovideo">
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
                            <img alt="user header" src="/images/photoandvideo.jpeg" width="100%" height="300"/>
                        </template>
                       
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                                quas!
                            </p>
                        </template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button label="Contact Us" severity="secondary" outlined class="w-full" />
                                <Button label="Order Now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="website">
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
                            <img alt="user header" src="/images/website.jpeg" width="100%" height="300"/>
                        </template>
                       
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                                quas!
                            </p>
                        </template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button label="Contact Us" severity="secondary" outlined class="w-full" />
                                <Button label="Order Now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="brand">
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
                            <img alt="user header" src="/images/brand.jpeg" width="100%" height="300"/>
                        </template>
                       
                        <template #content>
                            <p class="m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                                quas!
                            </p>
                        </template>
                        <template #footer>
                            <div class="flex gap-3 mt-1">
                                <Button label="Contact Us" severity="secondary" outlined class="w-full" />
                                <Button label="Order Now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

   
</template>

