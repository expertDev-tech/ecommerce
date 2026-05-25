<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import {
    router,
    Link,
    Head,
} from '@inertiajs/vue3'

defineProps({

    product: Object,

    images: Array,

})

const restoreImage = (
    imageId
) => {

    router.patch(
        route(
            'products.images.restore',
            imageId
        )
    )
}

const forceDeleteImage = (
    imageId
) => {

    if (
        !confirm(
            'Permanently delete this image?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'products.images.force-delete',
            imageId
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

                <div>

                    <h1
                        class="text-2xl font-bold text-gray-800"
                    >
                        Trash Images
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Restore deleted product images.
                    </p>

                </div>

                <Link
                    :href="
                        route(
                            'products.edit',
                            product.id
                        )
                    "
                    class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition"
                >
                    Back
                </Link>

            </div>

            <!-- Empty -->
            <div
                v-if="images.length === 0"
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
                    v-for="image in images"
                    :key="image.id"
                    class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm"
                >

                    <img
                        :src="`/storage/${image.image}`"
                        class="w-full h-48 object-cover opacity-70"
                    />

                    <div
                        class="p-4"
                    >

                        <div
                            class="flex gap-2"
                        >

                            <!-- Restore -->
                            <button
                                @click="
                                    restoreImage(
                                        image.id
                                    )
                                "
                                class="flex-1 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white text-sm transition"
                            >
                                Restore
                            </button>

                            <!-- Force Delete -->
                            <button
                                @click="
                                    forceDeleteImage(
                                        image.id
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