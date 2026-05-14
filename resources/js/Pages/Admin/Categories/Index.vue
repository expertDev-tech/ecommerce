<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { Head, Link } from '@inertiajs/vue3'

defineProps({
    categories: Object,
})
</script>

<template>

    <Head title="Categories" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-bold">
                    Categories
                </h1>

                <Link
                    :href="route('categories.create')"
                    class="admin-btn"
                >
                    + Add Category
                </Link>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full border-collapse">

                    <thead>
                        <tr class="bg-gray-100">

                            <th class="border p-3 text-left">
                                ID
                            </th>

                            <th class="border p-3 text-left">
                                Image
                            </th>

                            <th class="border p-3 text-left">
                                Name
                            </th>

                            <th class="border p-3 text-left">
                                Parent
                            </th>

                            <th class="border p-3 text-left">
                                Menu
                            </th>

                            <th class="border p-3 text-left">
                                Status
                            </th>

                            <th class="border p-3 text-left">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        <tr
                            v-for="category in categories.data"
                            :key="category.id"
                        >

                            <!-- ID -->
                            <td class="border p-3">
                                {{ category.id }}
                            </td>

                            <!-- Image -->
                            <td class="border p-3">

                                <img
                                    v-if="category.image"
                                    :src="`/storage/${category.image}`"
                                    class="w-16 h-16 object-cover rounded"
                                />

                            </td>

                            <!-- Name -->
                            <td class="border p-3">
                                {{ category.name }}
                            </td>

                            <!-- Parent -->
                            <td class="border p-3">
                                {{ category.parent?.name ?? '-' }}
                            </td>

                            <!-- Menu -->
                            <td class="border p-3">

                                <span
                                    v-if="category.show_in_menu"
                                    class="text-green-600"
                                >
                                    Yes
                                </span>

                                <span
                                    v-else
                                    class="text-red-600"
                                >
                                    No
                                </span>

                            </td>

                            <!-- Status -->
                            <td class="border p-3">

                                <span
                                    v-if="category.status"
                                    class="text-green-600"
                                >
                                    Active
                                </span>

                                <span
                                    v-else
                                    class="text-red-600"
                                >
                                    Inactive
                                </span>

                            </td>

                            <!-- Actions -->
                            <td class="border p-3">

                                <Link
                                    :href="route('categories.edit', category.id)"
                                    class="text-indigo-600"
                                >
                                    Edit
                                </Link>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </AdminLayout>

</template>