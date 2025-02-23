<template>
    <div class="d-flex">
        <Sidebar :treeList="treeList" :active="active" @updateTreeList="updateTreeList" @setActive="setActiveTree">
        </Sidebar>
        <div id="content" class="p-4">
            <TreeView :tree="tree"></TreeView>
        </div>
        <Modal v-if="isOpenModal" :title="getTitle()" @close="closeModal">
            <TreeItemForm :item="currentItem" :actionName="action" :actionButtonName="getButtonName()" :errors="errors"
                @close="closeModal" @action="callAction">
            </TreeItemForm>
        </Modal>
    </div>
</template>

<script>
import { defineAsyncComponent } from 'vue'
import Sidebar from '@/components/SideBar.vue';
import TreeView from '@/components/TreeView.vue';
import useTreeActionState from '@/plugins/treeActionState.js';
import Modal from '@/components/Modal.vue';
const TreeItemForm = defineAsyncComponent(() =>
    import('@/form/TreeItemForm.vue')
);
export default {
    name: 'Home',
    components: { Sidebar, TreeView, Modal, TreeItemForm },
    setup() {
        const { loadCurrentTree, action, active, setActive, setActiveTree, tree, errors, isOpenModal, currentItem, setOpenModal, updateTreeItem, createTreeItem, deleteTreeItem} = useTreeActionState();
        return {
            loadCurrentTree,
            active,
            action,
            tree,
            errors,
            isOpenModal,
            currentItem,
            setActive,
            setActiveTree,
            setOpenModal,
            updateTreeItem,
            createTreeItem,
            deleteTreeItem
        }
    },
    created() {
        this.loadTreeList();
    },
    data() {
        return {
            treeList: [],
        }
    },
    methods: {
        closeModal() {
            this.setOpenModal(false);
        },
        loadTreeList() {
            axios.get('/api/tree').then(({ data }) => {
                this.treeList = data.data;
                this.setActive((data.data.length > 0) ? data.data[0].id : null);
                if (this.active) {
                    this.loadCurrentTree(this.active);
                }
            }).catch((error) => { console.error(error); });
        },
        updateTreeList(data) {
            this.treeList.push(data);
            this.setActiveTree(data.id);
        },
        getTitle() {
            return (this.action === 'create') ? 'Create tree item' : (this.action === 'delete') ? 'Delete tree item' : 'Update tree item';
        },
        getButtonName() {
            return (this.action === 'create') ? 'Create' : (this.action === 'delete') ? 'Delete' : 'Update';
        },
        callAction(formData) {
            if (this.action === 'create') {
                this.createTreeItem(formData);
            } else if (this.action === 'update') {
                this.updateTreeItem(formData);
            } else if (this.action === 'delete') {
                this.deleteTreeItem(formData.id);
            }
        }
    }
}
</script>

<style scoped>
#content {
    width: 100%;
}
</style>
