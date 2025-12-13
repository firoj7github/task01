<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Products</h2>
            <button
                @click="handleAddProduct"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition"
            >
                + Add Product
            </button>
        </div>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-[800px] w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Name
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Price
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="item in items" :key="item.id">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ item.name }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ item.price }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                           <img
    v-if="item.image"
    :src="`http://localhost:8000/uploads/${item.image}`"
    alt="Product Image"
    class="h-12 w-12 object-cover rounded"
  />
  <span v-else>No Image</span>
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                        >
                            <router-link
                                :to="`/product/edit/${item.id}`"
                                class="text-indigo-600 hover:text-indigo-900"
                            >
                                Edit
                            </router-link>
                            <a
                                href="#"
                                class="ml-2 text-red-600 hover:text-red-900"
                                >Delete</a
                            >
                        </td>
                    </tr>
                    <tr v-if="!items.length">
                        <td
                            colspan="4"
                            class="text-center text-gray-500 py-6 text-lg"
                        >
                            No products available
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "@/axios";
import { useRouter } from "vue-router";

const router = useRouter();

const items = ref([]);
const loadProducts = async () => {
    try {
        const res = await axios.get("/api/products");
        console.log(res);
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
</script>
