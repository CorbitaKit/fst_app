<script setup>
    import { QuillEditor } from '@vueup/vue-quill'
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    import { ref } from 'vue';
    const props = defineProps({
        form: Object
    })
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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex flex-column">
                        <label for="title">Name</label>
                        <InputText id="title"  v-model="form.name" aria-describedby="title-help" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <QuillEditor theme="snow" :toolbar="toolbar" v-model:content="form.description" contentType="html" style="height: 300px;"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" class="btn btn-danger mr-1">Cancel</button>
            <button type="button" @click="$emit('submit')" class="btn btn-primary">Save and close</button>
        </div>
    </div>
</template>