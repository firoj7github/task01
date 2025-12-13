<template>
  <div class="min-h-screen bg-gray-100 flex flex-col items-center py-10">
    <div class="max-w-7xl w-full px-4 sm:px-6 lg:px-12">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Products</h2>
        <button @click="handleAddProduct" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
          + Add Product
        </button>
      </div>

      <!-- Scrollable table for md+ screens -->
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                Price
              </th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                Image
              </th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="item in items" :key="item.id">
              <td class="px-6 py-4 text-sm text-gray-500 break-words">{{ item.name }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">{{ item.price }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <img
                  v-if="item.image"
                  :src="`http://localhost:8000/uploads/products/${item.image}`"
                  alt="Product Image"
                  class="h-12 w-12 object-cover rounded"
                />
                <span v-else>No Image</span>
              </td>
              <td class="px-6 py-4 text-sm font-medium">
                <router-link :to="`/product/edit/${item.id}`" class="text-indigo-600 hover:text-indigo-900">
                  Edit
                </router-link>
                <button @click="deleteProduct(item.id)" class="ml-2 text-red-600 hover:text-red-900">
                  Delete
                </button>
              </td>
            </tr>
            <tr v-if="!items.length">
              <td colspan="4" class="text-center text-gray-500 py-6 text-lg">
                No products available
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "@/axios";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
import Swal from 'sweetalert2';

const router = useRouter();

const toast = useToast();

const items = ref([]);

const loadProducts = async () => {
    try {
        const res = await axios.get("/api/products");
        items.value = res.data.data;
    } catch (error) {
        console.error("Error loading items:", error);
    }
};

onMounted(() => {
    loadProducts();
});

const handleAddProduct = () => {
    router.push("/product/create");
};

const deleteProduct = async (id) => {
  const result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    });

    if (!result.isConfirmed) return;

  try {
    const res = await axios.delete(`/api/products/${id}`);
    
    if(res.data.success){
      toast.success(res.data.message); 
      items.value = items.value.filter(p => p.id !== id);
    } else {
      toast.error(res.data.message);
    }

  } catch (err) {
     toast.error('Something went wrong');
  }
};
</script>
