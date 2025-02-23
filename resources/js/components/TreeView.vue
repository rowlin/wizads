<template>
    <div>
        <ul class="tree">
            <li><TreeAction :item="tree"></TreeAction>
                <ul v-if="tree.children && tree.children.length > 0">
                    <tree-item :child="tree.children" />
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
import TreeAction from "./TreeAction.vue";
import TreeItem from "./TreeItem.vue";

export default {
    name: "TreeView",
    components: { TreeItem, TreeAction },
    props: {
        tree: {
            type: Object,
            required: true,
        },
    }
}
</script>

<style>
.tree {
    --spacing: 1.2rem;
    --radius: 11px;
}

.tree li {
    display: block;
    position: relative;
    padding-left: calc(2 * var(--spacing) - var(--radius) - 2px);
}

.tree ul {
    margin-left: calc(var(--radius) - var(--spacing));
    padding-left: 0;
}

.tree ul li {
    border-left: 2px solid #ddd;
}

.tree ul li:last-child {
    border-color: transparent;
}

.tree ul li::before {
    content: '';
    display: block;
    position: absolute;
    top: calc(var(--spacing) / -2);
    left: -2px;
    width: calc(var(--spacing) + 2px);
    height: calc(var(--spacing) + 1px);
    border: solid #ddd;
    border-width: 0 0 2px 2px;
}

.tree li::after {
    content: '';
    display: block;
    position: absolute;
    top: calc(var(--spacing) / 2 - var(--radius));
    left: calc(var(--spacing) - var(--radius) - 1px);
    width: calc(2 * var(--radius));
    height: calc(2 * var(--radius));
    border-radius: 50%;
    background: #ddd;
}

</style>
