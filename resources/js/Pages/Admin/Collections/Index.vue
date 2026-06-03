<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import {
    Head,
    Link,
    router,
} from '@inertiajs/vue3'

import {
    reactive,
    watch,
} from 'vue'

import {
    Pencil,
    Trash2
} from 'lucide-vue-next'

const props = defineProps({

    collections: Object,

    filters: Object,

})

const filterForm = reactive({

    search:
        props.filters.search || '',

    status:
        props.filters.status || '',

    featured:
        props.filters.featured || '',

})

watch(
    filterForm,
    () => {

        router.get(
            route('collections.index'),
            filterForm,
            {
                preserveState: true,
                replace: true,
            }
        )

    },
    {
        deep: true,
    }
)

const deleteCollection = (
    collectionId
) => {

    if (
        !confirm(
            'Delete this collection?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'collections.destroy',
            collectionId
        )
    )
}

</script>

<template>

    <Head title="Collections" />

    <AdminLayout>

        <div class="space-y-6">

            <!-- Header -->

            <div
                class="flex items-center justify-between"
            >

                <div>

                    <h1
                        class="text-3xl font-bold text-gray-800"
                    >
                        Collections
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Manage product collections.
                    </p>

                </div>

                <div class="flex gap-3">

                    <Link
                        :href="
                            route(
                                'collections.trash'
                            )
                        "
                        class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700"
                    >
                        Trash
                    </Link>

                    <Link
                        :href="
                            route(
                                'collections.create'
                            )
                        "
                        class="px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700"
                    >
                        Create Collection
                    </Link>

                </div>

            </div>

            <!-- Filters -->

            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-wrap gap-4"
            >

                <!-- Search -->

                <input
                    v-model="filterForm.search"
                    type="text"
                    placeholder="Search collection..."
                    class="rounded-xl border-gray-300"
                >

                <!-- Status -->

                <select
                    v-model="filterForm.status"
                    class="rounded-xl border-gray-300"
                >

                    <option value="">
                        All Status
                    </option>

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

                <!-- Featured -->

                <select
                    v-model="filterForm.featured"
                    class="rounded-xl border-gray-300"
                >

                    <option value="">
                        All Collections
                    </option>

                    <option value="1">
                        Featured
                    </option>

                    <option value="0">
                        Normal
                    </option>

                </select>

            </div>

            <!-- Table -->

            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden"
            >

                <!-- Empty -->

                <div
                    v-if="!collections.data.length"
                    class="py-20 text-center"
                >

                    <p
                        class="text-gray-500"
                    >
                        No collections found.
                    </p>

                </div>

                <!-- List -->

                <div
                    v-else
                    class="overflow-x-auto"
                >

                    <table
                        class="w-full text-sm"
                    >

                        <thead>

                            <tr
                                class="border-b bg-gray-50"
                            >

                                <th
                                    class="text-left px-6 py-4"
                                >
                                    Image
                                </th>

                                <th
                                    class="text-left px-6 py-4"
                                >
                                    Name
                                </th>

                                <th
                                    class="text-left px-6 py-4"
                                >
                                    Featured
                                </th>

                                <th
                                    class="text-left px-6 py-4"
                                >
                                    Status
                                </th>

                                <th
                                    class="text-right px-6 py-4"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="collection in collections.data"
                                :key="collection.id"
                                class="border-b"
                            >

                                <td
                                    class="px-6 py-4"
                                >

                                    <img
                                        v-if="collection.image"
                                        :src="`/storage/${collection.image}`"
                                        class="w-14 h-14 rounded-xl object-cover"
                                    >

                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <div
                                        class="font-medium text-gray-800"
                                    >
                                        {{ collection.name }}
                                    </div>

                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        v-if="collection.is_featured"
                                        class="px-2 py-1 rounded-lg bg-yellow-100 text-yellow-700 text-xs"
                                    >
                                        Featured
                                    </span>

                                    <span
                                        v-else
                                        class="text-gray-400"
                                    >
                                        —
                                    </span>

                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        v-if="collection.status"
                                        class="px-2 py-1 rounded-lg bg-green-100 text-green-700 text-xs"
                                    >
                                        Active
                                    </span>

                                    <span
                                        v-else
                                        class="px-2 py-1 rounded-lg bg-red-100 text-red-700 text-xs"
                                    >
                                        Inactive
                                    </span>

                                </td>

                                <td
                                    class="px-6 py-4"
                                >

                                    <div
                                        class="flex justify-end gap-3"
                                    >

                                        <Link
                                            :href="
                                                route(
                                                    'collections.edit',
                                                    collection.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-700"
                                        >
                                            <Pencil class="w-4 h-4" />
                                        </Link>

                                        <button
                                            @click="
                                                deleteCollection(
                                                    collection.id
                                                )
                                            "
                                            class="text-red-600 hover:text-red-700"
                                        >
                                            <Trash2 class="w-4 h-4" />
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Pagination -->

            <div
                class="flex justify-between items-center"
            >

                <div
                    class="text-sm text-gray-500"
                >

                    Showing
                    {{ collections.from }}
                    to
                    {{ collections.to }}
                    of
                    {{ collections.total }}
                    results

                </div>

                <div
                    class="flex gap-2"
                >

                    <template
                        v-for="link in collections.links"
                        :key="link.label"
                    >

                        <Link

                            v-if="link.url"

                            :href="link.url"

                            v-html="link.label"

                            preserve-scroll

                            class="px-3 py-1 rounded-lg border"

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