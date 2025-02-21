<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item m-1" v-if="authenticated">
                    <button class="btn btn-outline-danger" @click.prevent="$emit('logout')">Logout</button>
                </li>
                <li class="nav-item m-1" v-if="!authenticated">
                    <button :class="['btn', 'btn-outline-primary', { active: currentPage === 'Login' }]"
                        @click="$emit('goto', 'Login')">Login</button>
                </li>
                <li class="nav-item m-1" v-if="!authenticated">
                    <button :class="['btn', 'btn-outline-secondary', { active: currentPage === 'Register' }]"
                        @click="$emit('goto', 'Register')">Register</button>
                </li>
            </ul>
        </div>
    </nav>

</template>

<script>
export default {
    name: 'Navbar',
    emits: ['goto', 'logout'],
    props: {
        authenticated: {
            type: Boolean,
            required: true
        },
        currentPage: {
            type: String,
            required: true
        }
    }
};
</script>

<style scoped>
</style>
