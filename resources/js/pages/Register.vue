<script setup>
import useAuth from '@/plugins/useAuth.js'
import { reactive, ref } from 'vue'

const { registerRequest } = useAuth();

const validationErrors = ref([]);
const processing = ref(false);
const form = reactive({
    email: '',
    password: '',
    password_confirmation: '',
});

const register = async (form) => {
    processing.value = true;
    loginRequest(form).then(
        () => {
            this.$emit('goto', 'Home');
        })
        .catch(
            (errors) => {
                if (errors) {
                    validationErrors.value = errors
                }
            }
        ).finally(
            () => {
                processing.value = false;
            }
        );
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card shadow sm">
                        <div class="card-body">
                            <h1 class="text-center">Registration</h1>
                            <hr />
                            <form @submit.prevent="register">
                                <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input type="text" v-model="form.email" name="email" id="email"
                                        class="form-control">
                                </div>
                                <div class="form-group col-12 my-2">
                                    <label for="password" class="font-weight-bold">Password</label>
                                    <input type="password" v-model="form.password" name="password" id="password"
                                        class="form-control">
                                </div>
                                <div class="form-group col-12 my-2">
                                    <label for="password_confirmed" class="form-label">Password</label>
                                    <input type="password" id="password_confirmed" class="form-control"
                                        v-model="form.password_confirmed">
                                </div>

                                <div class="col-12 mb-2">
                                    <button type="submit" :disabled="processing"
                                        class="btn btn-primary btn-block">
                                        {{ processing ? "Please wait" : "Register" }}
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    <label>Are you have an account? <a href="#" @click="$emit('goto', 'Login')">Login
                                            Now!</a></label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    emits: ['goto'],
}
</script>

<style scoped></style>
