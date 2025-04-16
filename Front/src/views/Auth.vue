<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
      <h2 class="text-2xl font-semibold text-center mb-6">
        {{ isRegistering ? 'Register' : 'Login' }}
      </h2>
      
      <form @submit.prevent="handleSubmit">
        <!-- Name input (for registration only) -->
        <div v-if="isRegistering" class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
          <input 
            v-model="name" 
            type="text" 
            id="name" 
            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
            placeholder="Enter your full name"
            required
            :class="{'border-red-500': nameError}"
          />
          <p v-if="nameError" class="text-sm text-red-500">{{ nameError }}</p>
        </div>

        <!-- Email input -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input 
            v-model="email" 
            type="email" 
            id="email" 
            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
            placeholder="Enter your email"
            required 
            :class="{'border-red-500': emailError}"
          />
          <p v-if="emailError" class="text-sm text-red-500">{{ emailError }}</p>
        </div>
  
        <!-- Password input -->
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input 
            v-model="password" 
            type="password" 
            id="password" 
            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
            placeholder="Enter your password"
            required
            :class="{'border-red-500': passwordError}"
          />
          <p v-if="passwordError" class="text-sm text-red-500">{{ passwordError }}</p>
        </div>
  
        <!-- Confirm Password input for register -->
        <div v-if="isRegistering" class="mb-6">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input 
            v-model="passwordConfirmation" 
            type="password" 
            id="password_confirmation" 
            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
            placeholder="Confirm your password"
            required
            :class="{'border-red-500': passwordConfirmationError}"
          />
          <p v-if="passwordConfirmationError" class="text-sm text-red-500">{{ passwordConfirmationError }}</p>
        </div>
  
        <!-- Error and Success messages -->
        <p v-if="authError" class="text-sm text-red-500 text-center mb-4">{{ authError }}</p>
        <p v-if="authSuccess" class="text-sm text-green-500 text-center mb-4">{{ authSuccess }}</p>
  
        <!-- Submit button -->
        <button 
          type="submit" 
          class="w-full py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none"
          :disabled="isSubmitting"
        >
          {{ isRegistering ? 'Register' : 'Login' }}
        </button>
      </form>
  
      <p class="mt-4 text-sm text-center">
        <span v-if="isRegistering">
          Already have an account? 
          <a @click="toggleForm" class="text-indigo-600 cursor-pointer">Login</a>
        </span>
        <span v-if="!isRegistering">
          Don't have an account? 
          <a @click="toggleForm" class="text-indigo-600 cursor-pointer">Register</a>
        </span>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth'; // Ensure correct path
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const passwordConfirmation = ref('');
const name = ref('');
const emailError = ref('');
const passwordError = ref('');
const passwordConfirmationError = ref('');
const nameError = ref('');
const authError = ref('');
const authSuccess = ref('');
const isSubmitting = ref(false);
const isRegistering = ref(false); // Toggle for Register/Login form

const authStore = useAuthStore();
const router = useRouter();

// Validation regex for email and password
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

// Toggle between Register and Login forms
const toggleForm = () => {
  isRegistering.value = !isRegistering.value;
  // Reset all form fields and errors
  resetForm();
};

// Validate form inputs
const validateForm = () => {
  emailError.value = '';
  passwordError.value = '';
  passwordConfirmationError.value = '';
  nameError.value = '';
  authError.value = '';

  // Name validation for registration
  if (isRegistering.value && !name.value.trim()) {
    nameError.value = 'Please enter your full name';
    return false;
  }

  // Email validation
  if (!emailRegex.test(email.value)) {
    emailError.value = 'Please enter a valid email address';
    return false;
  }

  // Password validation
  if (!passwordRegex.test(password.value)) {
    passwordError.value = 'Password must be at least 8 characters long and contain both letters and numbers';
    return false;
  }

  // If it's the registration form, check if passwords match
  if (isRegistering.value && password.value !== passwordConfirmation.value) {
    passwordConfirmationError.value = 'Passwords do not match';
    return false;
  }

  return true;
};

// Reset form fields and errors
const resetForm = () => {
  email.value = '';
  password.value = '';
  passwordConfirmation.value = '';
  name.value = '';
  emailError.value = '';
  passwordError.value = '';
  passwordConfirmationError.value = '';
  nameError.value = '';
  authError.value = '';
  authSuccess.value = '';
};

// Handle submit logic (Login or Register)
const handleSubmit = async () => {
  if (isSubmitting.value) return; // Prevent multiple submissions

  isSubmitting.value = true;

  if (!validateForm()) {
    isSubmitting.value = false;
    return;
  }

  try {
    if (isRegistering.value) {
      // Call the register action
      await authStore.register(name.value, email.value, password.value);
      authSuccess.value = 'Registration successful!';
      // router.push('/dashboard'); // Redirect after successful registration
    } else {
      // Call the login action
      await authStore.login(email.value, password.value);
      authSuccess.value = 'Login successful!';
      router.push('/dashboard'); // Redirect after successful login
    }
  } catch (error) {
    authError.value = error.message || 'An error occurred. Please try again.';
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
/* Additional styling if needed */
</style>
