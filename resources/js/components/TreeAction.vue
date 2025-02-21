<template>
    <span>{{ item.name }}</span>
    <span @click="editAction">✎</span>
    <span @click="addAction">+</span>
    <span @click="removeAction">-</span>
</template>

<script>
export default {
    name: 'TreeAction',
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    methods: {
        editAction() {
            // Add your edit action logic here
        },
        addAction() {
            // Add your add action logic here
        },
        removeAction() {
            // Add your remove action logic here
        }
    }
}
</script>

<style></style>
