<template>
    <div class="d-flex">
        <Sidebar :treeList="treeList" :active="active" @updateTreeList="updateTreeList" @setActive="setActiveTree">
        </Sidebar>
        <div id="content" class="p-4">
            <div class="m-2">
                Filter by price <input type="number" v-model="price" @change="updateFilter" />
            </div>
            <hr />
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
import Sidebar from '@/components/SideBar.vue';
import TreeView from '@/components/TreeView.vue';
import useTreeActionState from '@/plugins/treeActionState.js';
import Modal from '@/components/Modal.vue';
import TreeItemForm from '@/form/TreeItemForm.vue';
export default {
    name: 'Home',
    components: { Sidebar, TreeView, Modal, TreeItemForm },
    setup() {
        const {
            loadCurrentTree,
            action,
            active,
            filterPrice,
            setFilterPrice,
            setActive,
            setActiveTree,
            tree,
            errors,
            isOpenModal,
            currentItem,
            setOpenModal,
            updateTreeItem,
            createTreeItem,
            deleteTreeItem
        } = useTreeActionState();

        return {
            loadCurrentTree,
            active,
            action,
            tree,
            errors,
            isOpenModal,
            currentItem,
            filterPrice,
            setFilterPrice,
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
            price: null,
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
        },
        updateFilter() {
            if (typeof this.price === 'number') {
                this.setFilterPrice(this.price);
            } else {
                this.price = 0;
                this.setFilterPrice(null);
            }
            this.loadCurrentTree(this.active);
        }

    }
}
</script>

<style scoped>
#content {
    width: 100%;
}
</style>
