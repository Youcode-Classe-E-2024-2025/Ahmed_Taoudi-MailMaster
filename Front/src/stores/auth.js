import { defineStore } from 'pinia';
import api from '@/services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    async login(email, password) {
      try {
        const response = await api.post('/login', { email, password });

        this.token = response.data.token;
        this.user = response.data.user;

        localStorage.setItem('token', this.token);

        api.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } catch (error) {
        throw new Error('Login failed');
      }
    },

    logout() {
      this.token = null;
      this.user = null;
      localStorage.removeItem('token');
      delete api.defaults.headers.common['Authorization'];
    },

    async fetchUser() {
      if (!this.token) return;
      try {
        const response = await api.get('/me');
        this.user = response.data;
      } catch {
        this.logout();
      }
    },
  },
});
