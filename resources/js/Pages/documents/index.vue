<script setup>
    
    import Column from 'primevue/column';
</script>


<template>
    <div class="active tab-pane" id="documents">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <TreeTable  class="`p-treetable-sm">
                        <template #header>
                            <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                                <span class="text-xl text-900 font-bold">Plan List</span>
                                <Button label="Add new plan"  icon="pi pi-plus" class="float-right" raised />
                            </div>
                        </template>
                        <Column field="name" header="Name" expander></Column>
                        <Column field="created_at" header="Created" ></Column>
                        <Column field="owner" header="Owner"></Column>
                        <Column field="updated_at" header="Last Modified" headerStyle="width: 10rem"></Column>
                        <Column>
                            <template #body="node">
                                <div class="flex flex-wrap">
                                    <Button class="mr-2" @click="getSelectedNode(node)" data-toggle="modal"  data-target="#details" v-tooltip.bottom="'View Details'" icon="pi pi-eye" rounded severity="info" raised />
                                    <Button type="button" :disabled="node.node.data.status == 'complete'" @click="markAsComplete(node.node.data)" v-tooltip.bottom="'Mark as complete'" icon="pi pi-check" rounded severity="success" raised />
                                </div>
                            </template>
                        </Column>
                    </TreeTable>
                </div>
            </div>
        </div>
    </div>
</template>