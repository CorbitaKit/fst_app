<script setup>
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
</script>


<template>
    <div class="active tab-pane" id="documents">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <DataTable>
                        <Column field="asset_name" header="Asset Name"></Column>
                        <Column field="tag" header="Tag"></Column>
                        <Column field="created_at" header="created"></Column>
                        <Column field="owner" header="Owner"></Column>
                        <Column field="updated_at" header="Last Modified"></Column>
                    </DataTable>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
</template>