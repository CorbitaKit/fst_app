<script setup>
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';
</script>

<template>
    <div class="row">
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
                                <i class="pi pi-linkedin mr-2" style="font-size: 2.5rem; color:green"></i>
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
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
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
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
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
                            <div class="flex gap-3 mt-1">
                                <Button style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
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