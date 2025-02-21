import './bootstrap';
import {createApp} from 'vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import useAuth from '@/plugins/useAuth.js';
import App from './App.vue'

const { attempt } = useAuth()

const app = createApp(App)

attempt().then(() => {
    app.mount('#app')
})
