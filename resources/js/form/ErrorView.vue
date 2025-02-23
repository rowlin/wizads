<template>
        <div class="alert alert-danger" v-if="Object.keys(errors).length > 0">
            <ul class="mb-0">
                <li v-for="(value, key) in errors" :key="key">{{ value[0] }}</li>
            </ul>
        </div>
</template>

<script>
export default {
    name: "ErrorView",
    props: {
        errors:{
            type: Object,
            required: false,
            default: {},
        }
    }
}
</script>

<style>

</style>
