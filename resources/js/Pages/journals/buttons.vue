<script setup>
    import axios from 'axios'
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    const props = defineProps({
        journal: Object
    })

    const btnAction = (journal_id, action) => {
       
    }

    function deleteJournal(journal_id) {
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
                axios.delete('/journals' + '/' + journal_id)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    router.get('/citizens/'+props.citizen.id)
                })
            }
        });
        
    }
</script>

<template>
    <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Edit">
        <i class="fas fa-edit"></i>
    </button>
    <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Time Log">
        <i class="far fa-clock"></i>
    </button>

    <button v-if="journal.is_favorite == 0" @click="btnAction(journal.id, 'add to favorite')" type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Favorite">
        <i class="far fa-star"></i>
    </button>
    <button v-if="journal.is_favorite == 1" type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Favorite">
        <i class="fas fa-star"></i>
    </button>
    <button type="button" v-if="journal.is_lock == 0" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Lock">
        <i class="fas fa-unlock"></i>
    </button>

    <button type="button" v-if="journal.is_lock == 1" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Lock">
        <i class="fas fa-lock"></i>
    </button>
    <button type="button" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Print">
        <i class="fas fa-print"></i>
    </button>
    <button type="button" @click="deleteJournal(journal.id)" class="btn btn-s bg-gradient-default mb-2 mr-2" title="Delete">
        <i class="fas fa-trash"></i>
    </button>
</template>