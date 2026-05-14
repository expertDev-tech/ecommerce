<script setup>
import { usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user
</script>

<template>
    <header class="bg-white shadow px-6 py-4 flex justify-between">

        <h2 class="text-lg font-semibold">
            Admin Dashboard
        </h2>

        <div>
            {{ user.name }}
        </div>

    </header>
</template>