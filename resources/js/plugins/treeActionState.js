import { computed, reactive } from 'vue'
import axios from 'axios'

const state = reactive({
    isOpenModal: false,
    currentItem: {},
    moveIsActive: true,
    action: 'create',
    tree: {},
    active: null,
    errors: {}
})

export default function useTreeActionState() {

    const isOpenModal = computed(() => state.isOpenModal)
    const currentItem = computed(() => state.currentItem)
    const action = computed(() => state.action)
    const tree = computed(() => state.tree)
    const active = computed(() => state.active)
    const errors = computed(() => state.errors)
    const moveIsActive = computed(() => state.moveIsActive)

    const setOpenModal = (isOpen) => {
        setErrors({})
        state.isOpenModal = isOpen
    }

    const setCurrentItem = (item) => {
        state.currentItem = item
    }

    const setAction = (actionValue) => {
        state.action = actionValue
    }

    const setActive = (id) => {
        state.active = id
    }

    const setTree = (tree) => {
        state.tree = tree
    }

    const setErrors = (errors) => {
        state.errors = errors
    }

    const setActiveTree = (id) => {
        setActive(id);
        if (id) {
            loadCurrentTree(id)
        }
    }

    const setMoveIsActive = (isMove) => {
        state.moveIsActive = isMove
    }

    const loadCurrentTree = async (id) => {
        await axios.get(`/api/tree/${id}`)
            .then(({ data }) => {
                setTree(data);
            }).catch((e) => {
                return Promise.reject(e.response.data.errors ?? e.response.data.message)
            });
    }

    const updateTreeItem = async (formData) => {
        await axios.patch(`/api/tree/item/${formData.id}`, formData)
            .then(() => {
                setOpenModal(false);
                setCurrentItem({});
                loadCurrentTree(active.value);
            }).catch((e) => {
                if (e.response.data.errors) {
                    setErrors(e.response.data.errors);
                }
            })
    }

    const createTreeItem = async (formData) => {
        await axios.post(`/api/tree/item/create`, formData)
            .then(() => {
                setOpenModal(false);
                setCurrentItem({});
                loadCurrentTree(active.value);
            }).catch((e) => {
                if (e.response.data.errors) {
                    setErrors(e.response.data.errors);
                }
            })
    }

    const deleteTreeItem = async (id) => {
        await axios.delete(`/api/tree/item/${id}`)
            .then(() => {
                setOpenModal(false);
                setCurrentItem({});
                loadCurrentTree(active.value);
            }).catch((e) => {
                console.error(e.response.data.errors);
            });
    }

    const moveTreeItem = async (formData) => {
        setMoveIsActive(false);
        await axios.put(`api/tree/item/move`, formData).then(() => {
            setMoveIsActive(true);
            loadCurrentTree(active.value);
        }).catch((e) => {
            console.error(e.response.data.errors);
        })
    }

    return {
        isOpenModal,
        currentItem,
        action,
        active,
        tree,
        errors,
        moveIsActive,
        setActive,
        setActiveTree,
        setOpenModal,
        setAction,
        setMoveIsActive,
        moveTreeItem,
        loadCurrentTree,
        setCurrentItem,
        updateTreeItem,
        createTreeItem,
        deleteTreeItem
    }
}
