<template>
    <li v-for="(el, index) in child" :key="index">
        <span class="m-2">{{ el.name }}<span>✎</span> </span>
        <TreeItem v-if="el.children && el.children.length > 0" :child="el.children">{{ el.name }}</TreeItem>
    </li>
</template>

<script>
export default {
    name:"TreeItem",
    props: {
        child: {
            type: Object,
            required: true
        }
    }
}
</script>

