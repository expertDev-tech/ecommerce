<script setup>

defineProps({

    form: Object,

    submit: Function,

    buttonText: String,

    collection: Object,

})

</script>

<template>

    <form
        @submit.prevent="submit"
        class="space-y-6"
    >

        <!-- Name -->
        <div>

            <label
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                Name
            </label>

            <input
                v-model="form.name"
                type="text"
                class="w-full rounded-xl border-gray-300"
            >

            <div
                v-if="form.errors.name"
                class="text-sm text-red-500 mt-2"
            >
                {{ form.errors.name }}
            </div>

        </div>

        <!-- Image -->
        <div>

            <label
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                Image
            </label>

            <input
                type="file"
                accept="image/*"
                @input="
                    form.image =
                        $event.target.files[0]
                "
                class="w-full rounded-xl border-gray-300"
            >

            <div
                v-if="form.errors.image"
                class="text-sm text-red-500 mt-2"
            >
                {{ form.errors.image }}
            </div>

            <div
                v-if="form.image"
                class="mt-3"
            >
                Selected new image
            </div>

            <div
                v-if="collection?.image"
                class="mt-4"
            >

                <img
                    :src="`/storage/${collection.image}`"
                    class="w-32 h-32 rounded-xl object-cover border"
                >

            </div>

        </div>

        <!-- Description -->
        <div>

            <label
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                Description
            </label>

            <textarea
                v-model="form.description"
                rows="5"
                class="w-full rounded-xl border-gray-300"
            ></textarea>

            <div
                v-if="form.errors.description"
                class="text-sm text-red-500 mt-2"
            >
                {{ form.errors.description }}
            </div>

        </div>

        <!-- Meta Title -->
        <div>

            <label
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                Meta Title
            </label>

            <input
                v-model="form.meta_title"
                type="text"
                class="w-full rounded-xl border-gray-300"
            >

            <div
                v-if="form.errors.meta_title"
                class="text-sm text-red-500 mt-2"
            >
                {{ form.errors.meta_title }}
            </div>

        </div>

        <!-- Meta Description -->
        <div>

            <label
                class="block text-sm font-medium text-gray-700 mb-2"
            >
                Meta Description
            </label>

            <textarea
                v-model="form.meta_description"
                rows="3"
                class="w-full rounded-xl border-gray-300"
            ></textarea>

            <div
                v-if="form.errors.meta_description"
                class="text-sm text-red-500 mt-2"
            >
                {{ form.errors.meta_description }}
            </div>

        </div>

        <!-- Featured -->
        <div
            class="flex items-center gap-3"
        >

            <input
                v-model="form.is_featured"
                type="checkbox"
                class="rounded border-gray-300"
            >

            <span
                class="text-sm font-medium text-gray-700"
            >
                Featured Collection
            </span>

        </div>

        <!-- Status -->
        <div
            class="flex items-center gap-3"
        >

            <input
                v-model="form.status"
                type="checkbox"
                class="rounded border-gray-300"
            >

            <span
                class="text-sm font-medium text-gray-700"
            >
                Active
            </span>

        </div>

        <!-- Submit -->
        <div>

            <button
                type="submit"
                :disabled="form.processing"
                class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium"
            >
                {{ buttonText }}
            </button>

        </div>

    </form>

</template>