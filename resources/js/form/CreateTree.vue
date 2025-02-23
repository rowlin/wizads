<template>
    <div class="modal-body">
        <ErrorView :errors="validationErrors"></ErrorView>
        <div class="mb-3">
            <label for="treeName" class="form-label">Name</label>
            <input type="text" class="form-control" id="treeName" v-model="form.name" placeholder="Enter tree name">
        </div>
        <div class="mb-3">
            <div class="form-check">
                <label class="form-check-label" for="isPublic">
                    Public
                </label>
                <input class="form-check-input" type="checkbox" id="isPublic" v-model="form.is_public">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="$emit('close')">Close</button>
        <button type="button" class="btn btn-primary" @click="createTree">Create</button>
    </div>
</template>

<script>
import ErrorView from "./ErrorView.vue";
export default {
    name: "CreateTree",
    components:{ErrorView},
    emits: ['close', 'updateTreeList'],
    data() {
        return {
            form: { name: "", is_public: true },
            validationErrors : [],
        }
    },
    methods: {
        createTree() {
            axios.post('/api/tree/create', this.form)
                .then(({data}) => {
                    this.$emit('updateTreeList', data.data);
                }).catch((error) => {
                    this.validationErrors = error.response.data.errors;
                });
        }

    }
}
</script>

<style></style>
