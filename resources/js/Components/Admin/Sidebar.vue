<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <aside class="w-64 bg-white shadow-md min-h-screen">

        <div class="p-5 border-b">
            <h1 class="text-xl font-bold">
                Admin Panel
            </h1>
        </div>

        <nav class="p-4 space-y-2">

            <Link
                href="/admin/dashboard"
                class="block px-4 py-2 rounded hover:bg-gray-100"
            >
                Dashboard
            </Link>

            <!-- <Link
                href="/admin/categories"
                class="block px-4 py-2 rounded hover:bg-gray-100"
            >
                Categories
            </Link> -->

            <Link
                :href="route('categories.index')"
                :class="[
                    route().current('categories.*')
                        ? 'bg-gray-200 font-semibold'
                        : '',
                    'block px-4 py-2 rounded hover:bg-gray-100'
                ]"
            >
                categories
            </Link>

            <Link
                :href="route('brands.index')"
                :class="[
                    route().current('brands.*')
                        ? 'bg-gray-200 font-semibold'
                        : '',
                    'block px-4 py-2 rounded hover:bg-gray-100'
                ]"
            >
                Brands
            </Link>

            <Link
                :href="route('attributes.index')"
                :class="[
                    route().current('attributes.*')
                        ? 'bg-gray-200 font-semibold'
                        : '',
                    'block px-4 py-2 rounded hover:bg-gray-100'
                ]"
            >
                Attributes
            </Link>

            <Link
                href="/admin/products"
                class="block px-4 py-2 rounded hover:bg-gray-100"
            >
                Products
            </Link>

        </nav>
    </aside>
</template>