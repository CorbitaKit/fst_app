<script setup>
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';
</script>

<template>
    <div class="row" id="other">
        <div class="col-md-3">
            <h5>Other</h5>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/office.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Microsoft Office</span>
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
                                <Button data-toggle="modal" data-target="#microsoft" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/email.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Secure mail</span>
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
                                <Button data-toggle="modal" data-target="#secure-mail" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/samtykke.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">SamtykkePlus</span>
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
                                <Button data-toggle="modal" data-target="#samtykke" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4 mt-5">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/hosting.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Hosting</span>
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
                                <Button data-toggle="modal" data-target="#hosting" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4 mt-5">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/clipcard.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">Clip Card</span>
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
                                <Button data-toggle="modal" data-target="#clipcard" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4 mt-5">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/ssl-certificate.png" class="mr-2" size="large" shape="square" />
                                <span class="text-xl text-900 font-bold">SSL Certificate</span>
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
                                <Button data-toggle="modal" data-target="#ssl" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button style="white-space: nowrap;" label="Order now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="modal fade" id="microsoft">
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
                            <img alt="user header" src="/images/microsoft.jpeg" width="100%" height="300"/>
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

    <div class="modal fade" id="secure-mail">
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
                            <img alt="user header" src="/images/secure-email.jpeg" width="100%" height="300"/>
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

    <div class="modal fade" id="samtykke">
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
                            <img alt="user header" src="/images/samtykke.jpeg" width="100%" height="300"/>
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

    <div class="modal fade" id="hosting">
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
                            <img alt="user header" src="/images/hosting.jpeg" width="100%" height="300"/>
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

    <div class="modal fade" id="clipcard">
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
                            <img alt="user header" src="/images/clipcard.jpeg" width="100%" height="300"/>
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

    <div class="modal fade" id="ssl">
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
                            <img alt="user header" src="/images/ssl.jpeg" width="100%" height="300"/>
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