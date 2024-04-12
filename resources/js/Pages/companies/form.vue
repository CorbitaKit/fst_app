<script setup>
    import { router } from "@inertiajs/vue3"
    const props = defineProps({
        form: Object,
        btnText: String,
        errors: Object
    })

    const emit = defineEmits(['submit'])
    const cancel = () => {
        router.get('/companies')
    }
</script>

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Company Details</h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex flex-column">
                                    <label for="company_name">Company Name</label>
                                    <InputText id="company_name" v-model="form.name" :invalid="errors.name" />
                                    <div class="text-danger text-xs" v-if="errors.name"> {{ errors.name[0] }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" @click="cancel"  class="btn btn-danger mr-1">Cancel</button>
                        <button type="submit" @click="$emit('submit')" class="btn btn-primary"> {{ btnText }} </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>