<script setup>
    import {useForm, router} from '@inertiajs/vue3';
    import {ref} from 'vue';
    import moment from 'moment';
  
    const props = defineProps({
        citizen: Object
    })

    const is_creating = ref(false)

    const form = useForm({
        'title': null,
        'date': null,
        'content': null,
        'is_draft': 0,
        'is_lock': 0,
        'is_favorite': 0, 
        'citizen_id': props.citizen.id
    })

    function createJournal() {
        is_creating.value = true
    }

    function submit() {
       form.post('/journals', {
        preventScroll: true,
        onSuccess: async () => {
            router.get('/citizens/'+props.citizen.id)
        }
       })
    }

    function formatDate(date) {
        return moment(date).format('MMMM D, YYYY hh:mm A');
    }

</script>
<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="https://via.placeholder.com/64"
                        alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ citizen.first_name }} {{ citizen.last_name }}</h3>
                    <div class="text-center">
                        <span>{{ citizen.address.address }}</span>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ citizen.email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="float-right">{{ citizen.phone }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#journal" data-toggle="tab">Journal</a></li>
                        <li class="nav-item"><a class="nav-link" href="#notifications" data-toggle="tab">Notifications</a></li>
                        <li class="nav-item"><a class="nav-link" href="#appointments" data-toggle="tab">Appointments</a></li>
                        <li class="nav-item"><a class="nav-link" href="#invoices" data-toggle="tab">Invoices</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="journal">
                            <div v-if="! is_creating">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <button type="button" @click.prevent="createJournal" class="btn bg-gradient-success mb-2 mr-2">
                                            <i class="fas fa-plus"></i>
                                            Add new journal
                                        </button>
                                        <button type="button" class="btn bg-gradient-primary mb-2 mr-2" title="Add a file or image to the journal ">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                        <button type="button" class="btn bg-gradient-primary mb-2 mr-2" title="Download Journal">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button type="button" class="btn bg-gradient-primary mb-2 mr-2" title="Print Journal">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <select class="form-control">
                                                        <option>Sort Newest First</option>
                                                        <option>Sort Oldest First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" >
                                                    <input type="email" class="form-control" placeholder="Search...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post" v-for="(journal, i) in citizen.journals" :key="i">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="https://via.placeholder.com/32" alt="user image">
                                        <span class="username">
                                            Created By <a href="#">Jonathan Burke Jr.</a>
                                        <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                        </span>
                                        <span class="description">Created at {{ formatDate(citizen.create_at) }}</span>
                                    </div>
                                    <p>
                                        {{ journal.content }}
                                    </p>

                                    <div class="text-right">
                                        <p>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Time Log">
                                                <i class="far fa-clock"></i>
                                            </button>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Favorite">
                                                <i class="far fa-star"></i>
                                            </button>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Unlock">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Print">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form v-else @submit.prevent="submit">
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
                                                <textarea class="form-control" v-model="form.content"></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="button" @click="is_creating = false" class="btn btn-danger mr-1">Cancel</button>
                                    <button type="submit" class="btn btn-success mr-1">Save as draft</button>
                                    <button type="submit" class="btn btn-primary">Save and close</button>
                                    
                                </div>
                                
                            </form>
                        </div>
                        <div class="tab-pane" id="notifications">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-danger">
                                10 Feb. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-primary"></i>

                                <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-user bg-info"></i>

                                <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-comments bg-warning"></i>

                                <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-success">
                                3 Jan. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="appointments">
                            <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
