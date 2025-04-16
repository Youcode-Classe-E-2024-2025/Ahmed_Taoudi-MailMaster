import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'; 
import { createPinia } from 'pinia';
const app = createApp(App);

app.use(createPinia());
app.use(router);

import { useAuthStore } from '@/stores/auth';
const authStore = useAuthStore();
authStore.initialize();

app.mount('#app')