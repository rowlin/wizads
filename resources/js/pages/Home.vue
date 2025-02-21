<template>
    <div class="d-flex">
        <Sidebar :treeList="treeList" :active="active" @updateTreeList="updateTreeList" @setActive="setActive">
        </Sidebar>
        <div id="content" class="p-4">
            <TreeView :tree="tree"></TreeView>
        </div>
    </div>
</template>

<script>
import Sidebar from '@/components/SideBar.vue';
import TreeView from '@/components/TreeView.vue';
export default {
    name: 'Home',
    components: { Sidebar, TreeView },
    created() {
        this.loadTreeList();
    },
    data() {
        return {
            treeList: [],
            active: null,
            tree: []
        }
    },
    methods: {
        loadTreeList() {
            axios.get('/api/tree').then(({ data }) => {
                this.treeList = data.data;
                this.active = (data.data.length > 0) ? data.data[0].id : null;
            }).catch((error) => { console.error(error); });
        },
        updateTreeList(data) {
            this.treeList.push(data);
            this.setActive(data.id, data);
        },
        setActive(id, data = null) {
            this.active = id;
            if (data) {
                console.log(data);
            } else {
                axios.get(`/api/tree/${id}`).then(({ data }) => {
                    console.log(data)
                    this.tree = data;
                }).catch((error) => { console.error(error); });
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
