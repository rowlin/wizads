<template>
    <nav id="sidebar" class="bg-light border-right">
        <button class="btn m-2 btn-outline-success" @click="showCreateTreeModal = true">Create Tree</button>
        <div class="sidebar-header">
            <h3>Tree list</h3>
        </div>
        <ul class="list-unstyled components">
            <li v-for="(item, index) in treeList" :key="index" :class="{ 'bg-primary text-white': active === item.id }">
                <div class="m-2" @click="setActive(item.id)">{{ item.name }}</div>
            </li>
        </ul>
    </nav>
    <Modal v-if="showCreateTreeModal" title="Create Tree" @close="closeCreateTreeModal">
        <CreateTree @close="closeCreateTreeModal" @updateTreeList="updateTreeList"></CreateTree>
    </Modal>
</template>

<script>

import Modal from './Modal.vue';
import CreateTree from '../form/CreateTree.vue';
export default {
    name: "SideBar",
    emits: ['updateTreeList', 'setActive'],
    components: {
        Modal,
        CreateTree
    },
    props: {
        treeList: {
            type: Array,
            requered: true
        },
        active: {
            type: [null, Number],
            required: false
        }
    },
    data() {
        return {
            showCreateTreeModal: false
        };
    },
    methods: {
        closeCreateTreeModal() {
            this.showCreateTreeModal = false;
        },
        setActive(id){
            this.$emit('setActive', id);
        },
        updateTreeList(data) {
            this.showCreateTreeModal = false;
            this.$emit('updateTreeList', data);
        }
    }
}
</script>

<style>
#sidebar {
    width: 250px;
    min-height: 100vh;
}
</style>
