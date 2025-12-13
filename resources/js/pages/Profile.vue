<template>
  <div v-if="user" class="max-w-md mx-auto pt-10">
    <div class="bg-white shadow-xl hover:shadow-2xl transition-shadow rounded-2xl p-8 border border-gray-200">
      <h2 class="text-3xl font-bold text-gray-800 mb-4">👤 User Profile</h2>
      <p class="text-gray-700 mb-2"><span class="font-semibold">Name:</span> {{ user.name }}</p>
      <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ user.email }}</p>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useAuthStore } from '../stores/auth';
import { storeToRefs } from 'pinia';

const auth = useAuthStore();
const { user } = storeToRefs(auth);

onMounted(async () => {
  await auth.init();
});
</script>
