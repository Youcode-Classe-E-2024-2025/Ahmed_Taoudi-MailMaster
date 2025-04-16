<template>
    <header class="bg-gray-800 text-white px-6 py-4 flex items-center justify-between">
      <h1 class="text-xl font-bold">MailMaster</h1>
  
      <nav>
        <ul class="flex space-x-4">
          <li><router-link to="/" class="hover:underline">Home</router-link></li>
          <li><router-link to="/dashboard" class="hover:underline">Dashboard</router-link></li>
        </ul>
      </nav>
  

      <div>
        <template v-if="isAuthenticated">
          <span class="mr-4">Welcome, {{ user?.name || 'User' }}</span>
          <button @click="logout" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
        </template>
  
        <template v-else>
          <router-link to="/connecte" class="mr-4 hover:underline">Connecter</router-link>
          
        </template>
      </div>
    </header>
  </template>
<script setup>
import { useAuthStore } from '@/stores/auth';

const auth = useAuthStore();
const { user, isAuthenticated, logout } = auth;

</script>  