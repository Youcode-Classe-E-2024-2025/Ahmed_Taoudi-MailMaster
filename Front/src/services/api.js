import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VUE_APP_API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

const token = localStorage.getItem('token');
if (token) {
  api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default api;
