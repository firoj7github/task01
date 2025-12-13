<template>
    <Navbar />
    <div class="min-h-screen bg-gray-50 flex flex-col justify-start">
        <router-view />
    </div>
</template>

<script setup>
import Navbar from "./components/Navbar.vue";
</script>

<style lang="scss" scoped></style>
