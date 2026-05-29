<script setup>

import {
    useForm,
    router,
    Link
} from '@inertiajs/vue3'

import {
    Trash2,
    Star
} from 'lucide-vue-next'

import {
    getYoutubeId,
    getVimeoId,
} from '@/Helpers/video'

const props = defineProps({

    product: Object,

})

/*
|--------------------------------------------------------------------------
| Form
|--------------------------------------------------------------------------
*/

const form = useForm({

    title: '',

    video_type: 'youtube',

    video_url: '',

})

/*
|--------------------------------------------------------------------------
| Submit
|--------------------------------------------------------------------------
*/

const submit = () => {

    form.post(

        route(
            'products.videos.store',
            props.product.id
        ),

        {

            forceFormData: true,

            preserveScroll: true,

            onSuccess: () => {

                form.reset()

                form.video_type = 'youtube'

            },

        }
    )

}

/*
|--------------------------------------------------------------------------
| Delete
|--------------------------------------------------------------------------
*/

const deleteVideo = (
    videoId
) => {

    if (
        !confirm(
            'Delete this video?'
        )
    ) {
        return
    }

    router.delete(

        route(
            'products.videos.destroy',
            videoId
        ),

        {
            preserveScroll: true,
        }
    )
}

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

const isYoutube = (
    url
) => {

    return url.includes(
        'youtube'
    ) || url.includes(
        'youtu.be'
    )
}

const isVimeo = (
    url
) => {

    return url.includes(
        'vimeo'
    )
}

const setPrimary = (
    videoId
) => {

    router.patch(
        route(
            'products.videos.primary',
            videoId
        ),
        {},
        {
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <div class="space-y-6">

        <!-- Form -->
        <div
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
        >

            <h2
                class="text-xl font-semibold text-gray-800 mb-6"
            >
                Product Videos
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-6"
            >

                <!-- Title -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Title
                    </label>

                    <input
                        v-model="form.title"
                        type="text"
                        class="w-full rounded-xl border-gray-300"
                        placeholder="Video title"
                    />

                    <div
                        v-if="form.errors.title"
                        class="text-sm text-red-500 mt-2"
                    >
                        {{ form.errors.title }}
                    </div>

                </div>

                <!-- Video Type -->
                <div>

                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Video Type
                    </label>

                    <select
                        v-model="form.video_type"
                        class="w-full rounded-xl border-gray-300"
                    >

                        <option value="youtube">
                            YouTube
                        </option>

                        <option value="vimeo">
                            Vimeo
                        </option>

                        <option value="upload">
                            Upload Video
                        </option>

                    </select>

                    <div
                        v-if="form.errors.video_type"
                        class="text-sm text-red-500 mt-2"
                    >
                        {{ form.errors.video_type }}
                    </div>

                </div>

            </div>

            <!-- URL -->
            <div
                v-if="form.video_type !== 'upload'"
                class="mt-6"
            >

                <label
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Video URL
                </label>

                <input
                    v-model="form.video_url"
                    type="text"
                    class="w-full rounded-xl border-gray-300"
                    placeholder="Paste video url"
                />

                <div
                    v-if="form.errors.video_url"
                    class="text-sm text-red-500 mt-2"
                >
                    {{ form.errors.video_url }}
                </div>

            </div>

            <!-- Upload -->
            <div
                v-else
                class="mt-6"
            >

                <label
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Upload Video
                </label>

                <input
                    type="file"
                    accept="video/*"
                    @input="
                        form.video_url =
                            $event.target.files[0]
                    "
                    class="w-full rounded-xl border-gray-300"
                />

                <div
                    v-if="form.errors.video_url"
                    class="text-sm text-red-500 mt-2"
                >
                    {{ form.errors.video_url }}
                </div>

            </div>

            <!-- Button -->
            <button
                @click="submit"
                :disabled="form.processing"
                class="mt-6 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition"
            >
                Add Video
            </button>

        </div>

        <!-- Video List -->
        <div
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
        >

            <div
                class="flex items-center justify-between mb-6"
            >

                <!-- Left -->
                <h2
                    class="text-xl font-semibold text-gray-800"
                >
                    Product Video List
                </h2>

                <!-- Right -->
                <div
                    class="flex items-center gap-4"
                >

                    <span
                        class="text-sm text-gray-500"
                    >
                        {{ product.videos?.length || 0 }}
                        Videos
                    </span>

                    <Link
                        :href="
                            route(
                                'products.videos.trash',
                                product.id
                            )
                        "
                        class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition"
                    >
                        Trash
                    </Link>

                </div>

            </div>

            <!-- Empty -->
            <div
                v-if="!product.videos?.length"
                class="border border-dashed border-gray-300 rounded-2xl py-16 text-center"
            >

                <p class="text-gray-500">
                    No videos added yet.
                </p>

            </div>

            <!-- Grid -->
            <div
                v-else
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6"
            >

                <div
                    v-for="video in product.videos"
                    :key="video.id"
                    class="border rounded-2xl overflow-hidden bg-gray-50"
                >

                    <!-- Youtube -->
                    <iframe
                        v-if="isYoutube(video.video_url)"
                        class="w-full h-52"
                        :src="`https://www.youtube.com/embed/${getYoutubeId(video.video_url)}`"
                        frameborder="0"
                        allowfullscreen
                    ></iframe>

                    <!-- Vimeo -->
                    <iframe
                        v-else-if="isVimeo(video.video_url)"
                        class="w-full h-52"
                        :src="`https://player.vimeo.com/video/${getVimeoId(video.video_url)}`"
                        frameborder="0"
                        allowfullscreen
                    ></iframe>

                    <!-- Upload -->
                    <video
                        v-else
                        controls
                        class="w-full h-52 object-cover"
                    >

                        <source
                            :src="`/storage/${video.video_url}`"
                        >

                    </video>

                    <!-- Content -->
                    <div class="p-4">

                        <h3
                            class="font-semibold text-gray-800"
                        >
                            {{ video.title || 'Video' }}
                        </h3>

                        <p
                            class="text-sm text-gray-500 mt-1 capitalize"
                        >
                            {{ video.video_type }}
                        </p>

                        <!-- Actions -->

                        <div
                            class="mt-4 flex items-center gap-3"
                        >

                            <!-- Primary -->
                            <button
                                v-if="!video.is_primary"
                                @click="
                                    setPrimary(video.id)
                                "
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:scale-105 transition-all duration-200"
                                title="Set Primary"
                            >
                                <Star class="w-4 h-4" />
                            </button>

                            <!-- Already Primary -->
                            <div
                                v-else
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600 shadow-sm"
                                title="Primary Video"
                            >
                                <Star class="w-4 h-4 fill-current" />
                            </div>

                            <!-- Delete -->
                            <button
                                @click="deleteVideo(video.id)"
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100 hover:scale-105 transition-all duration-200"
                                title="Delete Video"
                            >
                                <Trash2 class="w-4 h-4" />
                            </button>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</template>