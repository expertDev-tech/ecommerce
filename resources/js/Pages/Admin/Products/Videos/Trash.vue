<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import {
    router,
    Link,
    Head,
} from '@inertiajs/vue3'

import {
    getYoutubeId,
    getVimeoId,
} from '@/Helpers/video'

defineProps({

    product: Object,

    videos: Array,

})

const restoreVideo = (
    videoId
) => {

    router.patch(
        route(
            'products.videos.restore',
            videoId
        )
    )
}

const forceDeleteVideo = (
    videoId
) => {

    if (
        !confirm(
            'Permanently delete this video?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'products.videos.force-delete',
            videoId
        ),
        {
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <Head title="Trash Videos" />

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
                        Trash Videos
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Restore deleted product videos.
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
                v-if="videos.length === 0"
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
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >

                <div
                    v-for="video in videos"
                    :key="video.id"
                    class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm"
                >

                    <!-- Youtube -->
                    <iframe
                        v-if="
                            video.video_type === 'youtube'
                        "
                        class="w-full h-52"
                        :src="`https://www.youtube.com/embed/${getYoutubeId(video.video_url)}`"
                        frameborder="0"
                        allowfullscreen
                    />

                    <!-- Vimeo -->
                    <iframe
                        v-else-if="
                            video.video_type === 'vimeo'
                        "
                        class="w-full h-52"
                        :src="`https://player.vimeo.com/video/${getVimeoId(video.video_url)}`"
                        frameborder="0"
                        allowfullscreen
                    />

                    <!-- Upload -->
                    <video
                        v-else
                        controls
                        class="w-full h-52 object-cover"
                    >

                        <source
                            :src="`/storage/${video.video_url}`"
                        />

                    </video>

                    <div
                        class="p-4 space-y-4"
                    >

                        <div>

                            <p
                                class="font-semibold text-gray-800"
                            >
                                {{
                                    video.title
                                    ||
                                    'Untitled Video'
                                }}
                            </p>

                            <p
                                class="text-sm text-gray-500 capitalize"
                            >
                                {{
                                    video.video_type
                                }}
                            </p>

                        </div>

                        <div
                            class="flex gap-2"
                        >

                            <!-- Restore -->
                            <button
                                @click="
                                    restoreVideo(
                                        video.id
                                    )
                                "
                                class="flex-1 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white text-sm transition"
                            >
                                Restore
                            </button>

                            <!-- Force Delete -->
                            <button
                                @click="
                                    forceDeleteVideo(
                                        video.id
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
