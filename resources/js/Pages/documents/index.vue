<script setup>
    import { ref, onMounted } from 'vue';
    import 'sweetalert2/src/sweetalert2.scss';
    import Swal from 'sweetalert2'

    import axios from 'axios';
    import { useForm } from '@inertiajs/vue3';
    const props = defineProps({
        citizen_id: Number
    })
    const documents = ref(null)
    const is_creating = ref(false)
    const is_next = ref(false)
    const fileInput = ref(null)
    const file_size = ref({})
    const form = useForm({
        'parent_id': 0,
        'citizen_id': props.citizen_id,
        'user_id': 0,
        'file_name': null,
        'type': ''
    })
    onMounted(() => {
        fetchDocuments()
        fetchFileSizes()
    })

    const submit = () => {
        form.post('/folders', {
            onSuccess: () => {
                Swal.fire({
                    title: "Success!",
                    text: "Folder created successfully!",
                    icon: "success"
                });
                is_creating.value = false
                fetchDocuments()
            }
        })
    }

    const fetchDocuments = () => {
        axios.get('/documents/get-citizen-documents/' + props.citizen_id)
        .then((response) => {
            documents.value = response.data
        })
    }

    const formatDate = (date) => {
        return moment(date).locale('da').format('D. MMM YYYY');
    }

    const getDocumentsChildren = (parent_id) => {
        is_next.value = true
        form.parent_id = parent_id
        axios.get('/documents/get-document-children/' + parent_id)
        .then(response => {
            documents.value = response.data
        })
    }

    const openFileUpload = () => {
      fileInput.value.click();
    };

    const handleFileUpload = () => {
      form.file_name = fileInput.value.files[0]
      form.post('/documents', {
        onSuccess: () => {
            Swal.fire({
                title: "Success!",
                text: "File uploaded successfully!",
                icon: "success"
            });
            fetchDocuments()
            fetchFileSizes()
        }
      })
    }

    const fetchFileSizes = async () => {
        try {
            const response = await axios.get('/documents/get-file-size/' + props.citizen_id);
            file_size.value = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    const calculateAverageGB = () => {
        const size = file_size.total.split(" ")
        console.log(size)
    }



</script>


<template>
    <div class="active tab-pane" id="documents">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>File Name</th>
                            <th>Created</th>
                            <th>Owner</th>
                            <th>Last Modified</th>
                            <th>
                               
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(document, i) in documents" :key="i">
                            <td>
                                <Image src="/images/folder.png" alt="Image" width="30" v-if="document.type == 'Folder'"/> 
                                <Image src="/images/photo.png" alt="Image" width="30" v-if="document.type == 'Image'"/> 
                                <Image src="/images/clapperboard.png" alt="Image" width="30" v-if="document.type == 'Video'"/> 
                                <Image src="/images/document.png" alt="Image" width="30" v-if="document.type == 'Application' || document.type == 'Text'"/> 
                            </td>
                            <td> {{ document.file_name }}</td>
                            <td> {{ formatDate(document.created_at) }}</td>
                            <td> {{ document.user_id }}</td>
                            <td>{{ formatDate(document.updated_at) }}</td>
                            <td>
                                <Button v-if="document.type == 'Folder'" icon="pi pi-angle-right" @click="getDocumentsChildren(document.id)"></Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              
               
            </div>
            <div class="col-md-3 mb-2">
                <button v-if="!is_creating" class="btn btn-block btn-success" @click="is_creating = true">Create new folder</button>
                <InputGroup v-if="is_creating">
                    <Button icon="pi pi-times" severity="danger" @click="is_creating = false"/>
                    <InputText placeholder="Folder Name" v-model="form.file_name"/>
                    <Button icon="pi pi-check" severity="success" @click="submit"/>
                    
                </InputGroup>
                <div id="drop_area" class="mt-2" @dragover.prevent @drop="handleDrop">
                    <button class="btn btn-block btn-default" @click="openFileUpload"><i class="fas fa-upload"></i> Upload File</button>
                    <input webkitdirectory directory multiple type="file" ref="fileInput" style="display: none;" @change="handleFileUpload">
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                    <h3 class="card-title">Storage</h3>
                    </div>
                    <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file"></i> Documents
                                <span class="float-right">{{ file_size.document }}</span>
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-image"></i> Images
                                <span class="float-right">{{ file_size.image }}</span>
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-image"></i> Videos
                                <span class="float-right">{{ file_size.video }}</span>
                            </a>
                        </li>
                    
                    </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="mt-3">
                    <ProgressBar :value="file_size.average" />
                    
                    <div class="d-flex justify-content-center align-items-center">
                        <span>{{ file_size.total }} out of 5GB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>