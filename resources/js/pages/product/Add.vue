<template>
    <div class="min-h-screen bg-gray-100 flex items-start justify-center py-10">
        <div class="bg-white shadow-lg rounded-lg max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-12 py-8">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">
                Add Product
            </h2>

            <form @submit.prevent="submitProduct" class="space-y-5">
                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Name</label>
                    <input
                        type="text"
                        v-model="name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product name"
                    />
                    <small v-if="errors.name" class="text-red-500 text-sm">
                      {{
                        errors.name[0]
                      }}
                    </small>
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Price</label>
                    <input
                        type="number"
                        v-model="price"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product price"
                    />
                    <small v-if="errors.price" class="text-red-500 text-sm">
                      {{
                        errors.price[0]
                      }}
                    </small>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Image</label>
                    <input
                        type="file"
                        @change="handleImage"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <small v-if="errors.image" class="text-red-500 text-sm">
                      {{
                        errors.image[0]
                      }}
                    </small>

                    <!-- Preview existing or new image -->
                    <div v-if="imagePreview || existingImage" class="mt-3">
                        <img
                            :src="imagePreview ? imagePreview : existingImage"
                            class="h-32 object-contain rounded"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "@/axios";
import { useToast } from "vue-toastification";
import { useRouter } from "vue-router";

const name = ref("");
const price = ref("");
const image = ref(null);
const imagePreview = ref(null);
const errors = ref({});

const toast = useToast();
const router = useRouter();

// Image change handler
const handleImage = (e) => {
    const file = e.target.files[0];
    if (file) {
        image.value = file;
        imagePreview.value = URL.createObjectURL(file);
    }
};

// Submit product
const submitProduct = async () => {
    errors.value = {};

    try {
        const formData = new FormData();
        formData.append("name", name.value);
        formData.append("price", price.value);
        if (image.value) formData.append("image", image.value);

        const res = await axios.post("/api/products/store", formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        toast.success(res.data.message);

        // Reset form
        name.value = "";
        price.value = "";
        image.value = null;
        imagePreview.value = null;

        // redirect
        await router.push("/product");
    } catch (err) {
        if (err.response?.status === 422) {
            errors.value = err.response.data.errors;
        } else {
            toast.error("Something went wrong");
        }
    }
};
</script>
