<script setup>
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import axios from 'axios'
    const props = defineProps({
        medicines: Object
    })

    const deleteMedicine = (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/medicines' + '/' + id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Medicine has been deleted.",
                        icon: "success"
                    });
                })
            }
        });
    }
</script>

<template>
    <div class="modal fade" id="medList">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Citizens Medicine List</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date Given</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(medicine, i) in medicines" :key="i">
                            <td>
                                {{ medicine.name }}
                            </td>
                            <td> {{ medicine.description }} </td>
                            <td>{{ medicine.date_given }}</td>
                            <td>
                                <div class="btn-group">
                                   
                                    <button type="button" class="btn btn-sm btn-info mr-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" @click="deleteMedicine(medicine.id)" class="btn btn-sm btn-danger mr-1">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>