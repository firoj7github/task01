<template>
    <div class="flex min-h-screen flex-col justify-center px-6 lg:px-8 bg-gray-500">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">
                Register to your account
            </h2>
        </div>

        <div class="mt-8 mb-5 sm:mx-auto sm:w-full sm:max-w-sm bg-white p-10 rounded">
            <form @submit.prevent="register" method="POST" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-800">Name</label>
                    <div class="mt-2">
                        <input
                            id="name"
                            type="name"
                            name="name"
                            v-model="name"
                            class="block w-full rounded-md px-3 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div v-if="auth.error?.name" class="text-red-500 text-sm mt-0.5">
                        {{ auth.error.name[0] }}
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-800">Email address</label>
                    <div class="mt-2">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            v-model="email"
                            class="block w-full rounded-md px-3 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div v-if="auth.error?.email" class="text-red-500 text-sm mt-0.5">
                        {{ auth.error.email[0] }}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label
                            for="password"
                            class="block text-sm/6 font-medium text-gray-800"
                            >Password</label
                        >
                    </div>
                    <div class="mt-2">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            v-model="password"
                            class="block w-full rounded-md px-3 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div v-if="auth.error?.password" class="text-red-500 text-sm mt-0.5">
                        {{ auth.error.password[0] }}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-800">
                            Confirm Password
                        </label>
                    </div>
                    <div class="mt-2">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            v-model="password_confirmation"
                            class="block w-full rounded-md px-3 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                            placeholder="Confirm your password"
                        />
                    </div>
                    <div v-if="auth.error?.password_confirmation" class="text-red-500 text-sm mt-0.5">
                        {{ auth.error.password_confirmation[0] }}
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Sign up
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-600">
                Already have a account?
                <a href="user/login" class="font-semibold text-indigo-400 hover:text-indigo-500">Login</a>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useToast } from "vue-toastification";
import { useRouter } from "vue-router";

const router = useRouter();
const toast = useToast();
const name = ref("");
const email = ref("");
const password = ref("");
const auth = useAuthStore();

const register = async () => {
    try {
        const resData = await auth.register(
            name.value,
            email.value,
            password.value
        );

        if (auth.token) {
            toast.success(resData.message);
            await router.push("/profile");
        }
    } catch (err) {
        if (err.response?.status === 422) {
            errors.value = err.response.data.errors;
        }
    }
};
</script>
