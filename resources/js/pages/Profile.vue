

<template>
  <div v-if="user" class="max-w-md mx-auto pt-10">
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800 mb-2">👤 User Profile</h2>
      <p class="text-gray-600"><span class="font-semibold">Name:</span> {{ user.name }}</p>
      <p class="text-gray-600"><span class="font-semibold">Email:</span> {{ user.email }}</p>
      
    </div>
  </div>

</template>

<script setup>
import { onMounted, ref} from 'vue';
import { useAuthStore } from '../stores/auth';
import { storeToRefs } from 'pinia';

const auth = useAuthStore();
const { user } = storeToRefs(auth);
console.log(user);
onMounted( async()=>{
  await auth.init();
});
</script>
