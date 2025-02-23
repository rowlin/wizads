<template>
    <li v-for="(el, index) in child" :key="index" :attr-dropId="el.id">
        <TreeAction :item="el"></TreeAction>
        <TreeItem v-if="el.children && el.children.length > 0" :child="el.children">{{ el.name }}</TreeItem>
    </li>
</template>

<script>
import TreeAction from "./TreeAction.vue";
export default {
    name:"TreeItem",
    components: { TreeAction },
    props: {
        child: {
            type: Object,
            required: true
        }
    }
}
</script>

