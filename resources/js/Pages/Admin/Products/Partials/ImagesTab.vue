<script setup>

import {
    useForm,
    router,
    Link
} from '@inertiajs/vue3'

import {
    Pencil,
    Trash2,
    Star,
} from 'lucide-vue-next'

import { ref } from 'vue'

const props = defineProps({

    product: Object,

})

/*
|--------------------------------------------------------------------------
| Upload Form
|--------------------------------------------------------------------------
*/

const form = useForm({

    images: [],

})

/*
|--------------------------------------------------------------------------
| Upload Images
|--------------------------------------------------------------------------
*/

const submit = () => {

    form.post(
        route(
            'products.images.store',
            props.product.id
        ),
        {
            forceFormData: true,

            preserveScroll: true,

            onSuccess: () => {

                form.reset()

            },
        }
    )
}

/*
|--------------------------------------------------------------------------
| Alt Text Form
|--------------------------------------------------------------------------
*/

const altTextForm = useForm({

    alt_text: '',

})

/*
|--------------------------------------------------------------------------
| Editing Image
|--------------------------------------------------------------------------
*/

const editingImageId = ref(null)

/*
|--------------------------------------------------------------------------
| Set Primary Image
|--------------------------------------------------------------------------
*/

const setPrimary = (
    imageId
) => {

    router.patch(
        route(
            'products.images.primary',
            imageId
        ),
        {},
        {
            preserveScroll: true,
        }
    )
}

/*
|--------------------------------------------------------------------------
| Toggle Status
|--------------------------------------------------------------------------
*/

const toggleStatus = (
    imageId
) => {

    router.patch(
        route(
            'products.images.status',
            imageId
        ),
        {},
        {
            preserveScroll: true,
        }
    )
}

/*
|--------------------------------------------------------------------------
| Update Alt Text
|--------------------------------------------------------------------------
*/

const updateAltText = (
    image
) => {

    altTextForm
        .transform(() => ({

            alt_text:
                image.alt_text,

        }))
        .patch(
            route(
                'products.images.alt-text',
                image.id
            ),
            {
                preserveScroll: true,

                onSuccess: () => {

                    editingImageId.value = null

                },
            }
        )
}

/*
|--------------------------------------------------------------------------
| Delete Image
|--------------------------------------------------------------------------
*/

const deleteImage = (
    imageId
) => {

    if (
        !confirm(
            'Delete this image?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'products.images.destroy',
            imageId
        ),
        {
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <div class="space-y-6">

        <!-- Upload Section -->
        <div
            class="relative z-10 bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
        >

            <div
                class="flex items-center justify-between mb-6"
            >

                <div>

                    <h2
                        class="text-xl font-semibold text-gray-800"
                    >
                        Product Images
                    </h2>

                    <p
                        class="text-sm text-gray-500 mt-1"
                    >
                        Upload gallery images for this product.
                    </p>

                </div>

            </div>

            <!-- Upload Input -->
            <div
                class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-indigo-400 transition"
            >

                <input
                    type="file"
                    multiple
                    class="block w-full text-sm text-gray-500"
                    @input="form.images = $event.target.files"
                />

                <p
                    class="text-xs text-gray-400 mt-3"
                >
                    JPG, PNG, WEBP up to 2MB
                </p>

            </div>

            <!-- Validation Error -->
            <div
                v-if="form.errors.images"
                class="text-red-500 text-sm mt-2"
            >
                {{ form.errors.images }}
            </div>

            <!-- Upload Button -->
            <button
                @click="submit"
                :disabled="form.processing"
                class="mt-5 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition disabled:opacity-50"
            >
                {{
                    form.processing
                        ? 'Uploading...'
                        : 'Upload Images'
                }}
            </button>

        </div>

        <!-- Gallery -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
        >

           <div
                class="flex items-start justify-between mb-6"
            >

                <!-- Left -->
                <div>

                    <h2
                        class="text-xl font-semibold text-gray-800"
                    >
                        Product Gallery
                    </h2>

                    <p
                        class="text-sm text-gray-500 mt-1"
                    >
                        Manage uploaded product images.
                    </p>

                </div>

                <!-- Right -->
                <div
                    class="flex items-center gap-4 shrink-0"
                >

                    <!-- Total -->
                    <span
                        class="text-sm text-gray-500"
                    >
                        {{
                            product.images.length
                        }}
                        Images
                    </span>

                    <!-- Trash -->
                    <Link
                        :href="
                            route(
                                'products.images.trash',
                                product.id
                            )
                        "
                        class="relative z-10 inline-flex items-center px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-sm font-medium transition"
                    >
                        Trash
                    </Link>

                </div>

            </div>

            <!-- Empty State -->
            <div
                v-if="product.images.length === 0"
                class="border border-dashed border-gray-300 rounded-2xl py-16 text-center"
            >

                <p
                    class="text-gray-500"
                >
                    No images uploaded yet.
                </p>

            </div>

            <!-- Images Grid -->
            <div
                v-else
                class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5"
            >

                <div
                    v-for="image in product.images"
                    :key="image.id"
                    class="group relative flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition"
                >

                    <!-- Image -->
                    <div class="h-52 bg-gray-100">

                        <img
                            :src="`/storage/${image.image}`"
                            :alt="image.alt_text"
                            class="w-full h-full object-cover"
                        />

                    </div>

                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition pointer-events-none"
                    ></div>

                    <!-- Primary Badge -->
                    <div
                        v-if="image.is_primary"
                        class="absolute top-3 left-3 bg-green-600 text-white text-xs px-2 py-1 rounded-lg"
                    >
                        Primary
                    </div>

                    <!-- Sort Order -->
                    <div
                        class="absolute top-3 right-3 bg-white text-gray-700 text-xs px-2 py-1 rounded-lg shadow"
                    >
                        #{{ image.sort_order }}
                    </div>

                    <!-- Footer -->
                    <div
                        class="flex flex-col flex-1 justify-between p-4 border-t bg-white min-h-[110px]"
                    >

                        <!-- Alt Text -->
                        <div
                            class="flex items-start justify-between gap-2"
                        >

                            <template
                                v-if="editingImageId === image.id"
                            >

                                <div class="w-full space-y-2">

                                    <input
                                        v-model="image.alt_text"
                                        type="text"
                                        class="w-full border rounded-lg px-3 py-2 text-xs"
                                        placeholder="Enter alt text"
                                    />

                                    <div class="flex gap-2">

                                        <button
                                            @click="updateAltText(image)"
                                            class="text-xs bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg"
                                        >
                                            Save
                                        </button>

                                        <button
                                            @click="editingImageId = null"
                                            class="text-xs bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg"
                                        >
                                            Cancel
                                        </button>

                                    </div>

                                </div>

                            </template>

                            <template v-else>

                                <p
                                    class="text-xs text-gray-500 line-clamp-2 break-words"
                                >
                                    {{ image.alt_text || 'No alt text' }}
                                </p>

                            </template>

                        </div>

                        <!-- Actions -->
                        <div
                            class="flex items-center justify-between mt-4"
                        >

                            <!-- Left Actions -->
                            <div
                                class="flex items-center gap-2"
                            >

                                <!-- Edit -->
                                <button
                                    @click="editingImageId = image.id"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-indigo-50 text-indigo-600 transition"
                                    title="Edit Alt Text"
                                >
                                    <Pencil class="w-4 h-4" />
                                </button>

                                <!-- Primary -->
                                <button
                                    v-if="!image.is_primary"
                                    @click="setPrimary(image.id)"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-yellow-50 text-yellow-600 transition"
                                    title="Set Primary"
                                >
                                    <Star class="w-4 h-4" />
                                </button>

                                <!-- Already Primary -->
                                <div
                                    v-else
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600"
                                    title="Primary Image"
                                >
                                    <Star class="w-4 h-4 fill-current" />
                                </div>

                                <!-- Delete -->
                                <button
                                    @click="deleteImage(image.id)"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-red-50 text-red-600 transition"
                                    title="Delete Image"
                                >
                                    <Trash2 class="w-4 h-4" />
                                </button>

                            </div>

                            <!-- Status Toggle -->
                            <button
                                @click="toggleStatus(image.id)"
                                class="relative inline-flex h-5 w-10 items-center rounded-full transition"
                                :class="

                                    image.status
                                        ? 'bg-green-500'
                                        : 'bg-gray-300'

                                "
                            >

                                <span
                                    class="inline-block h-4 w-4 transform rounded-full bg-white transition"
                                    :class="

                                        image.status
                                            ? 'translate-x-5'
                                            : 'translate-x-1'

                                    "
                                />

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>