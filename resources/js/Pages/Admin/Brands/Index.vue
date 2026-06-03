<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { Head, Link } from '@inertiajs/vue3'

import {
    Pencil
} from 'lucide-vue-next'

defineProps({
    brands: Object,
})
</script>

<template>

    <Head title="Brands" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">

                <h1 class="text-2xl font-bold">
                    Brands
                </h1>

                <Link
                    :href="route('brands.create')"
                    class="admin-btn"
                >
                    + Add Brand
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
                                Status
                            </th>

                            <th class="border p-3 text-left">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        <tr
                            v-for="brand in brands.data"
                            :key="brand.id"
                        >

                            <!-- ID -->
                            <td class="border p-3">
                                {{ brand.id }}
                            </td>

                            <!-- Image -->
                            <td class="border p-3">

                                <img
                                    v-if="brand.logo"
                                    :src="`/storage/${brand.logo}`"
                                    class="w-16 h-16 object-cover rounded"
                                />

                            </td>

                            <!-- Name -->
                            <td class="border p-3">
                                {{ brand.name }}
                            </td>


                            <!-- Status -->
                            <td class="border p-3">

                                <span
                                    v-if="brand.status"
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
                                    :href="route('brands.edit', brand.id)"
                                    class="text-indigo-600"
                                >
                                    <Pencil class="w-4 h-4" />
                                </Link>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </AdminLayout>

</template>