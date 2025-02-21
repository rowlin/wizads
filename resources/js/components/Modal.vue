<template>
    <div class="modal" tabindex="-1" style="display: block; background: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ title }}</h4>
                    <button type="button" class="btn-close" @click="$emit('close')"></button>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        title: {
            type: String,
            default: 'Create Tree'
        }
    }
};
</script>

<style scoped>
/* Add any custom styles for the modal here */
</style>
