<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import {
    router,
    Link,
    Head,
} from '@inertiajs/vue3'

defineProps({
    collections: Array,
})

const restoreCollection = (
    collectionId
) => {

    router.patch(
        route(
            'collections.restore',
            collectionId
        )
    )
}

const forceDeleteCollection = (
    collectionId
) => {

    if (
        !confirm(
            'Permanently delete this collection?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'collections.force-delete',
            collectionId
        ),
        {
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <Head title="Trash Images" />

    <AdminLayout>

        <div
            class="space-y-6"
        >

            <!-- Header -->
            <div
                class="flex items-center justify-between"
            >

                <Link
                    :href="
                        route(
                            'collections.index'
                        )
                    "
                    class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition"
                >
                    Back
                </Link>

                <div>

                    <h1
                        class="text-2xl font-bold text-gray-800"
                    >
                        Trash Collections
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Restore deleted collections.
                    </p>

                </div>

            </div>

            <!-- Empty -->
            <div
                v-if="collections.length === 0"
                class="bg-white border border-dashed border-gray-300 rounded-2xl py-16 text-center"
            >

                <p
                    class="text-gray-500"
                >
                    Trash is empty.
                </p>

            </div>

            <!-- Grid -->
            <div
                v-else
                class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5"
            >

                <div
                    v-for="coll in collections"
                    :key="coll.id"
                    class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm"
                >

                    <!-- Image -->
                    <img
                        v-if="coll.image"
                        :src="`/storage/${coll.image}`"
                        class="w-full h-44 object-cover opacity-70"
                    >

                    <div
                        v-else
                        class="w-full h-44 bg-gray-100 flex items-center justify-center text-gray-400"
                    >
                        No Image
                    </div>

                    <div class="p-4">

                        <h3
                            class="font-semibold text-gray-800 truncate"
                        >
                            {{ coll.name }}
                        </h3>

                        <p
                            class="text-sm text-gray-500 mt-1 line-clamp-2"
                        >
                            {{ coll.description || 'No description' }}
                        </p>

                        <div
                            class="flex gap-2 mt-4"
                        >

                            <button
                                @click="
                                    restoreCollection(
                                        coll.id
                                    )
                                "
                                class="flex-1 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white text-sm transition"
                            >
                                Restore
                            </button>

                            <button
                                @click="
                                    forceDeleteCollection(
                                        coll.id
                                    )
                                "
                                class="flex-1 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm transition"
                            >
                                Delete
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </AdminLayout>

</template>