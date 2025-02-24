<template>
    <span class="m-2 droptarget" draggable="true" :attr-dragid="item.id">
        <span class="droptarget" :attr-dropid="item.id" >{{ item.name }}</span> <span v-if="showPrice"> [ {{ item.price }}]</span>
        <span class="icon_box" >
            <span class="icon" @click="editAction">✎</span>
            <span class="icon" @click="addAction">+</span>
            <span class="icon" v-if="showRemoveAction" @click="removeAction">-</span>
        </span>
    </span>
    <span class="droptarget" :attr-dropid="item.id"></span>
</template>

<script>
import useTreeActionState from '@/plugins/treeActionState.js';
export default {
    name: 'TreeAction',
    props: {
        item: {
            type: Object,
            required: true
        },
        showRemoveAction: {
            type: Boolean,
            required: false,
            default: true
        },
        showPrice: {
            type: Boolean,
            required: false,
            default: true
        }
    },
    setup() {
        const { setAction, setCurrentItem, setOpenModal, deleteTreeItem } = useTreeActionState();
        return {
            deleteTreeItem,
            setCurrentItem,
            setOpenModal,
            setAction
        }
    },
    methods: {
        editAction() {
            const currentItem = { id: this.item.id, name: this.item.name, price: this.item.price };
            this.setCurrentItem(currentItem);
            this.setAction('update')
            this.setOpenModal(true);
        },
        addAction() {
            const currentItem = { name: '', price: '', parent_id: this.item.id };
            this.setCurrentItem(currentItem);
            this.setAction('create');
            this.setOpenModal(true);
        },
        removeAction() {
            if (this.item.children.length > 0) {
                const currentItem = { id: this.item.id, price: '', parent_id: '' };
                this.setCurrentItem(currentItem);
                this.setAction('delete');
                this.setOpenModal(true);
            } else {
                this.deleteTreeItem(this.item.id);
            }

        }
    }
}
</script>

<style scoped>
.droptarget {
    cursor: pointer;
}

.icon_box {
    margin-left: 20px;
}

.icon {
    display: inline-block;
    transform: scale(2, 2);
    height: 30px;
    width: 30px;
    cursor: pointer;
}
</style>
