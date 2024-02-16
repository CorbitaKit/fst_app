<script setup>
    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import {ref} from 'vue'
    const props = defineProps({
        form: Object
    })

    const emit = defineEmits(['cancelAction', 'submit'])

    const toolbar = ref([
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        ['link'],
        [{ 'header': 1 }, { 'header': 2 }],
        ['image']
    ])

    defineOptions({
        QuillEditor
    })
</script>


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
                        <QuillEditor theme="snow" :toolbar="toolbar" v-model:content="form.content" contentType="html" style="height: 300px;"/>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-end">
            <button type="button" @click="$emit('cancelAction')" class="btn btn-danger mr-1">Cancel</button>
            <button type="submit" class="btn btn-success mr-1">Save as draft</button>
            <button type="button" @click="$emit('submit')" class="btn btn-primary">Save and close</button>
        </div>
        
    </form>
</template>