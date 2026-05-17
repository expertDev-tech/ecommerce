<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import { Head, Link, router } from '@inertiajs/vue3'

defineProps({
    attributes: Object,
})

const restore = (id) => {

    router.put(
        route('attributes.restore', id)
    )
}

</script>

<template>

    <Head title="Trash Attributes" />

    <AdminLayout>

        <div class="space-y-6">

            <!-- Header -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between"
            >

                <div>

                    <h1
                        class="text-3xl font-bold text-gray-800"
                    >
                        Trash Attributes
                    </h1>

                    <p
                        class="text-gray-500 mt-2"
                    >
                        Restore deleted product attributes.
                    </p>

                </div>

                <Link
                    :href="route('attributes.index')"
                    class="px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition"
                >
                    Back
                </Link>

            </div>

            <!-- Table Card -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
            >

                <!-- Table Header -->
                <div
                    class="p-6 border-b border-gray-100 flex items-center justify-between"
                >

                    <h2
                        class="text-xl font-semibold text-gray-800"
                    >
                        Deleted Attributes
                    </h2>

                    <span
                        class="text-sm text-gray-500"
                    >
                        Total:
                        {{ attributes.data.length }}
                    </span>

                </div>

                <!-- Table -->
                <div class="overflow-x-auto">

                    <table
                        class="w-full"
                    >

                        <thead
                            class="bg-gray-50"
                        >

                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    ID
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Category
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Attribute Name
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Type
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Deleted At
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="attribute in attributes.data"
                                :key="attribute.id"
                                class="border-b border-gray-100 hover:bg-gray-50 transition"
                            >

                                <td
                                    class="px-6 py-4 text-gray-700"
                                >
                                    {{ attribute.id }}
                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        class="px-3 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-sm font-medium"
                                    >
                                        {{ attribute.category?.name }}
                                    </span>

                                </td>

                                <td
                                    class="px-6 py-4 font-medium text-gray-800"
                                >
                                    {{ attribute.name }}
                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        class="px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-sm"
                                    >
                                        {{ attribute.type }}
                                    </span>

                                </td>

                                <td
                                    class="px-6 py-4 text-sm text-gray-500"
                                >
                                    {{ attribute.deleted_at }}
                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <button
                                        @click="restore(attribute.id)"
                                        class="px-4 py-2 rounded-lg bg-green-100 hover:bg-green-200 text-green-700 font-medium transition"
                                    >
                                        Restore
                                    </button>

                                </td>

                            </tr>

                            <!-- Empty State -->
                            <tr
                                v-if="attributes.data.length === 0"
                            >

                                <td
                                    colspan="6"
                                    class="px-6 py-10 text-center text-gray-500"
                                >
                                    No deleted attributes found.
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </AdminLayout>

</template>