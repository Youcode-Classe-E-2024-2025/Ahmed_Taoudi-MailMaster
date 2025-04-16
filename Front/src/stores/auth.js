import { defineStore } from 'pinia';
import api from '@/services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null,
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
  },

  actions: {
    initialize() {
      if (this.token) {
        api.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.fetchUser(); 
      }
    },
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
      console.log('auth.login', 'token :' + this.token);
    },

    // New register method
    async register(name,email, password) {
      try {
        const response = await api.post('/register', { name ,email, password });
      } catch (error) {
        throw new Error('Registration failed');
      }
    },

    logout() {
      this.token = null;
      this.user = null;
      localStorage.removeItem('token');
      delete api.defaults.headers.common['Authorization'];
      console.log('auth.logout', 'token :' + this.token);
    },

    async fetchUser() {
      if (!this.token) return;
      try {
        const response = await api.get('/user');
        this.user = response.data;
        localStorage.setItem('user',JSON.stringify(response.data))
        console.log('auth.initialize', 'token :' + this.token , 'user : ', this.user);
      } catch {
        // this.logout();
      }
    },
  },
});
