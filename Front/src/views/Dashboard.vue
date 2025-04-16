<template>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

        <div class="mb-6">
            <button @click="showModal = true" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create New Newsletter
            </button>
        </div>
        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-lg">
                <h3 class="text-xl font-bold mb-4">New Newsletter</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input v-model="form.title" type="text" class="w-full mt-1 border px-3 py-2 rounded" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea v-model="form.description" rows="3"
                        class="w-full mt-1 border px-3 py-2 rounded"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button @click="showModal = false"
                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                    <button @click="submitNewsletter"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Save
                    </button>
                </div>
            </div>
        </div>
        <div v-if="newsletters.length === 0" class="text-gray-500">
            No newsletters created yet.
        </div>

        <div v-else>
            <ul>
                <li v-for="newsletter in newsletters" :key="newsletter.id" class="mb-4">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">{{ newsletter.title }}</span>
                        <button @click="deleteNewsletter(newsletter.id)"
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                    <p class="text-gray-600">{{ newsletter.description }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '@/services/api';
import { useAuthStore } from '@/stores/auth';

const showModal = ref(false);
const form = ref({
    title: '',
    description: ''
});

const auth = useAuthStore();
const newsletters = ref([]);

const fetchNewsletters = async () => {
    try {
        const response = await api.get('/newsletters'); // Assuming your API endpoint is /newsletters
        newsletters.value = response.data;
        console.log(response.data);
    } catch (error) {
        console.error('Error fetching newsletters:', error);
    }
};

const submitNewsletter = async () => {
    try {
        const response = await api.post('/newsletters', {
            title: form.value.title,
            content: form.value.description,
            status:'planifiée'
        });

        newsletters.value.unshift(response.data);
        showModal.value = false;
        form.value.title = '';
        form.value.description = '';
    } catch (error) {
        console.error('Error creating newsletter:', error);
    }
};

const deleteNewsletter = async (id) => {
    try {
        await api.delete(`/newsletters/${id}`); // Delete newsletter by ID
        newsletters.value = newsletters.value.filter(newsletter => newsletter.id !== id);
    } catch (error) {
        console.error('Error deleting newsletter:', error);
    }
};

onMounted(() => {
    fetchNewsletters();
});
</script>