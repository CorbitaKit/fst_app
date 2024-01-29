<script setup>
    import {router} from '@inertiajs/vue3';

    defineProps({
        citizens: Object
    })
    function createNewCitizen() {
        router.get('/citizens/create')
    }

    function show(id) {
        router.get('/citizens/'+id)
    }
   
</script>

<template>
    <div class="row">
        <div class="col-md-3">
            <button type="button" @click.prevent="createNewCitizen" class="btn btn-block bg-gradient-success mb-2">
                <i class="fas fa-user-plus mr-2"></i>
                Add new citizen
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(citizen, i) in citizens" :key="i" @click="show(citizen.id)">
                            <td>
                                <img src="https://via.placeholder.com/32" alt="User Image" class="img-circle img-size-32">
                            </td>
                            <td> {{  citizen.first_name }} {{ citizen.last_name }} </td>
                            <td>{{  citizen.email }}</td>
                            <td>{{  citizen.phone }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-info mr-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger">
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
    </div>
</template>
