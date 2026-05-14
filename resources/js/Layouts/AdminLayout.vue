<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex">

        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <Header />

            <!-- Page Content -->
            <main class="p-6">
                <slot />
            </main>

        </div>
    </div>
</template>