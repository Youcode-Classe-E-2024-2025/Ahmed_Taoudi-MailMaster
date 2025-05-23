import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/views/Home.vue';
import Auth from '@/views/Auth.vue';
import Dashboard from '@/views/Dashboard.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/connecte',
    name: 'Auth',
    component: Auth,
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
