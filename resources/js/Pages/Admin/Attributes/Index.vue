<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import { Head, Link } from '@inertiajs/vue3'

import { router } from '@inertiajs/vue3'

import { ref, watch } from 'vue'

const props = defineProps({

    attributes: Object,

    filters: Object,

})

const search = ref(
    props.filters.search || ''
)

watch(search, (value) => {

    router.get(

        route('attributes.index'),

        {
            search: value,
        },

        {
            preserveState: true,
            replace: true,
        }
    )

})

const destroy = (id) => {

    if (confirm('Are you sure?')) {

        router.delete(
            route('attributes.destroy', id)
        )
    }
}

</script>

<template>

    <Head title="Attributes" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <!-- Header -->
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6"
            >

                <!-- Left -->
                <div>

                    <h1
                        class="text-2xl font-bold text-gray-800"
                    >
                        Attributes
                    </h1>

                </div>

                <!-- Right -->
                <div
                    class="flex flex-col md:flex-row items-stretch md:items-center gap-3"
                >

                    <!-- Search -->
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search attributes..."
                        class="w-full md:w-72 rounded-xl border-gray-300"
                    />

                    <!-- Add -->
                    <Link
                        :href="route('attributes.create')"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition"
                    >
                        + Add Attribute
                    </Link>

                    <!-- Trash -->
                    <Link
                        :href="route('attributes.trash')"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition"
                    >
                        Trash
                    </Link>

                </div>

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
                                Category Name
                            </th>

                            <th class="border p-3 text-left">
                                Attribute Name
                            </th>

                            <th class="border p-3 text-left">
                                Type
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
                            v-for="attribute in attributes.data"
                            :key="attribute.id"
                        >

                            <!-- ID -->
                            <td class="border p-3">
                                {{ attribute.id }}
                            </td>

                            <!-- Image -->
                            <td class="border p-3">

                                {{ attribute.category.name }}

                            </td>

                            <!-- Name -->
                            <td class="border p-3">
                                {{ attribute.name }}
                            </td>

                            <td class="border p-3">
                                {{ attribute.type }}
                            </td>


                            <!-- Status -->
                            <td class="border p-3">

                                <span
                                    v-if="attribute.status"
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
                                    :href="route('attributes.edit', attribute.id)"
                                    class="text-indigo-600"
                                >
                                    Edit
                                </Link>

                                <button
                                    @click="destroy(attribute.id)"
                                    class="ml-3 text-red-600 hover:underline"
                                >
                                    Delete
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>
            <!-- pagination -->
            <div
                class="flex items-center justify-between mt-6"
            >

                <div
                    class="text-sm text-gray-500"
                >
                    Showing
                    {{ attributes.from }}
                    to
                    {{ attributes.to }}
                    of
                    {{ attributes.total }}
                    results
                </div>

                <div
                    class="flex gap-2"
                >

                    <template
                        v-for="link in attributes.links"
                        :key="link.label"
                    >

                        <button

                            v-if="link.url"

                            v-html="link.label"

                            @click="
                                router.visit(link.url)
                            "

                            class="px-3 py-1 rounded-lg border text-sm"

                            :class="
                                link.active
                                    ? 'bg-indigo-600 text-white'
                                    : 'bg-white'
                            "
                        />

                    </template>

                </div>

            </div>

        </div>

    </AdminLayout>

</template>