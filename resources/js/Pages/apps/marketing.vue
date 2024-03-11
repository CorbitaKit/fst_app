<script setup>
    import Card from 'primevue/card';
    import Button from 'primevue/button';
    import Avatar from 'primevue/avatar';
    import { ref } from 'vue';

    const visible = ref(false)
</script>

<template>
    <div class="row" id="marketing">
        <div class="col-md-3">
            <h5>Marketing</h5>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/adwords.png" class="mr-2" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">Google Ads</span>
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
                                <Button data-toggle="modal" data-target="#google-ad" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/meta.png" class="mr-3" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">Meta Ads</span>
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
                                <Button data-toggle="modal" data-target="#meta-ad" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/linkedin.png" class="mr-2" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">Linkedin Ads</span>
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
                                <Button data-toggle="modal" data-target="#linkedin-ad" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-md-4 mt-5">
                    <Card>
                        <template #title>
                            <div class="flex align-items-center">
                                <Avatar image="/images/seo.png" class="mr-2" size="large" shape="circle" />
                                <span class="text-xl text-900 font-bold">SEO</span>
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
                                <Button data-toggle="modal" data-target="#seo" style="white-space: nowrap;" label="Read more" severity="secondary" outlined class="w-full" />
                                <Button data-toggle="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="modal fade" id="google-ad">
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
                            <img alt="user header" src="/images/google.jpeg" width="100%" height="300"/>
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
                                <Button data-toggle="modal" data-dismiss="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="meta-ad">
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
                            <img alt="user header" src="/images/meta.jpeg" width="100%" height="300"/>
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
                                <Button data-toggle="modal" data-dismiss="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="linkedin-ad">
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
                            <img alt="user header" src="/images/linkedin.jpeg" width="100%" height="300"/>
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
                                <Button data-toggle="modal" data-dismiss="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="seo">
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
                            <img alt="user header" src="/images/seo.jpeg" width="100%" height="300"/>
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
                                <Button data-toggle="modal" data-dismiss="modal" data-target="#activate_now" style="white-space: nowrap;" label="Activate" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="flex gap-3 mt-1">
                               
                                <Button label="I accept, activate now" class="w-full" />
                            </div>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </div>
</template>