<script setup>
    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import { useForm, router } from '@inertiajs/vue3';
    import { ref } from 'vue'

    const props = defineProps({
        citizen_id: Number,
        is_creating: Boolean
    })

    const form = useForm({
        'title': null,
        'date': null,
        'content': null,
        'is_draft': 0,
        'is_lock': 0,
        'is_favorite': 0, 
        'citizen_id': props.citizen_id,
    })

    const submit = () => {
        form.post('/journals', {
            preserveScroll: true,
            onSuccess: () => {
                router.get('/citizens/'+props.citizen_id)
            }
        })
    }

    const emit = defineEmits(['cancelAction'])
    defineOptions({
        QuillEditor
    })

</script>
<style scoped>
    .ql-container ql-snow{
        height: 200px !important;
    }
</style>
<template>
    <form>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" v-model="form.title"  placeholder="Enter title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="date" class="form-control" v-model="form.date"  placeholder="Enter First Name">
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <QuillEditor theme="snow" toolbar="full" v-model:content="form.content" contentType="html"/>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-end">
            <button type="button" @click="$emit('cancelAction')" class="btn btn-danger mr-1">Cancel</button>
            <button type="submit" class="btn btn-success mr-1">Save as draft</button>
            <button type="button" @click="submit" class="btn btn-primary">Save and close</button>
        </div>
        
    </form>
</template>