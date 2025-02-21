import { computed, reactive } from 'vue'
import axios from 'axios'

const state = reactive({
    authenticated: false,
    user: {}
})

export default function useAuth() {
    const authenticated = computed(() => state.authenticated)
    const user = computed(() => state.user)

    const setAuthenticated = (authenticated) => {
        state.authenticated = authenticated
    }

    const setUser = (user) => {
        state.user = user
    }

    const registerRequest = async (formData) => {
        await axios.get('/sanctum/csrf-cookie')

        try {
            await axios.post('/api/register', formData)
            return attempt()
        } catch (e) {
            return Promise.reject(e.response.data.errors ?? e.response.data.message)
        }
    }

    const loginRequest = async (credentials) => {
        await axios.get('/sanctum/csrf-cookie')

        try {
            await axios.post('/api/login', credentials)
            return attempt()
        } catch (e) {
            return Promise.reject(e.response.data.errors ?? e.response.data.message)
        }
    }

    const logoutRequest = async () => {
        await axios.post('/api/logout').then(
            () => {
                setAuthenticated(false);
                setUser({});
            }
        );
    }

    const attempt = async () => {
        try {
            let response = await axios.get('/api/user');

            setAuthenticated(true);
            setUser(response.data);

            return response;
        } catch (e) {
            setAuthenticated(false);
            setUser({});
        }
    }

    return {
        authenticated,
        user,
        registerRequest,
        loginRequest,
        logoutRequest,
        attempt
    }
}
