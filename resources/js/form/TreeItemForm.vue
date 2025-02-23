<template>
    <div class="modal-body" v-if="actionName !== 'delete'">
        <ErrorView :errors="errors"></ErrorView>
        <div class="mb-3">
            <label for="itemName" class="form-label">Name</label>
            <input type="text" class="form-control" minlength="2" maxlength="50" id="itemName" v-model="item.name"
                required>
        </div>
        <div class="mb-3">
            <label for="itemPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="itemPrice" v-model="item.price" required>
        </div>

    </div>
    <div class="modal-body" v-else>
                This item have childer. Are you sure to delete it with childer?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="$emit('close')">Close</button>
        <button type="button" class="btn btn-primary" @click="$emit('action', item)">{{ actionButtonName }}</button>
    </div>
</template>

<script>

import ErrorView from "./ErrorView.vue";
export default {
    name: 'TreeItemForm',
    emits: ['close', 'action'],
    components: { ErrorView },
    props: {
        item: {
            type: Object,
            required: true
        },
        actionButtonName: {
            type: String,
            required: true,
            default: "Create"
        },
        errors: {
            type: Object,
            required: true,
            default: {}
        },
        actionName:{
            type: String,
            required: true,
        }
    },
}
</script>

<style></style>
