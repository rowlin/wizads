<script setup>
import useAuth from '@/plugins/useAuth.js'
import Home from './pages/Home.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
const { authenticated, logoutRequest } = useAuth();

const pages = [Login, Register];
</script>

<template>
    <div id="app" class="min-vh-100">
        <Navbar :currentPage="currentPage" :authenticated="authenticated" @goto="goto" @logout="logoutRequest" />
        <main>
            <div v-if="!authenticated">
                <component :is="pages.find((page) => page.name === currentPage)" @goto="goto"></component>
            </div>
            <div v-else>
                <Home></Home>
            </div>
        </main>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';

export default {
    name: 'App',
    components: {
        Navbar
    },
    data() {
        return {
            currentPage: 'Login',
        };
    },
    methods: {
        goto(page) {
            this.currentPage = page;
        }
    },
};
</script>

<style>
</style>
