<template>
    <div class="flex min-h-screen flex-col justify-center px-6 lg:px-8 bg-gray-500">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm bg-white p-10 rounded">
            <form @submit.prevent="login" class="space-y-6">
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
                        <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
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
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-600">
                Not a account?
                <a
                    href="/user/register"
                    class="font-semibold text-indigo-400 hover:text-indigo-500"
                    >Register
                </a>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useToast } from "vue-toastification";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";

const router = useRouter();
const toast = useToast();
const email = ref("");
const password = ref("");
const auth = useAuthStore();
const { message } = storeToRefs(auth);

const login = async () => {
   try {
    const resData = await auth.login(email.value, password.value);

    if (auth.token) {
        toast.success(resData.message);
        await router.push("/profile");
    }
} catch (error) {
    
    if (error.response && error.response.data && error.response.data.message) {
        toast.error(error.response.data.message);
    } else {
        toast.error("Something went wrong");
    }
}

    
};
</script>
