<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
    form: Object,
    categories: Array,
    submit: Function,
    buttonText: {
        type: String,
        default: 'Save',
    },
})
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">

        <!-- Parent Category -->
        <div>
            <InputLabel for="parent_id" value="Parent Category" />

            <select
                v-model="form.parent_id"
                class="mt-1 block w-full rounded-md border-gray-300"
            >
                <option :value="null">
                    None
                </option>

                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>

            <InputError
                :message="form.errors.parent_id"
                class="mt-2"
            />
        </div>

        <!-- Name -->
        <div>
            <InputLabel for="name" value="Name" />

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
            />

            <InputError
                :message="form.errors.name"
                class="mt-2"
            />
        </div>

        <!-- Slug -->
        <div>
            <InputLabel for="slug" value="Slug" />

            <TextInput
                id="slug"
                type="text"
                class="mt-1 block w-full"
                v-model="form.slug"
            />

            <InputError
                :message="form.errors.slug"
                class="mt-2"
            />
        </div>

        <!-- Image -->
        <div>
            <InputLabel for="image" value="Image" />

            <input
                type="file"
                class="mt-1 block w-full"
                @change="form.image = $event.target.files[0]"
            />

            <InputError
                :message="form.errors.image"
                class="mt-2"
            />
        </div>

        <!-- Description -->
        <div>
            <InputLabel
                for="description"
                value="Description"
            />

            <textarea
                v-model="form.description"
                rows="4"
                class="mt-1 block w-full rounded-md border-gray-300"
            ></textarea>

            <InputError
                :message="form.errors.description"
                class="mt-2"
            />
        </div>

        <!-- Sort Order -->
        <div>
            <InputLabel
                for="sort_order"
                value="Sort Order"
            />

            <TextInput
                id="sort_order"
                type="number"
                class="mt-1 block w-full"
                v-model="form.sort_order"
            />

            <InputError
                :message="form.errors.sort_order"
                class="mt-2"
            />
        </div>

        <!-- Show In Menu -->
        <div class="flex items-center gap-2">

            <input
                type="checkbox"
                id="show_in_menu"
                v-model="form.show_in_menu"
            />

            <InputLabel
                for="show_in_menu"
                value="Show In Menu"
            />
        </div>

        <!-- Status -->
        <div class="flex items-center gap-2">

            <input
                type="checkbox"
                id="status"
                v-model="form.status"
            />

            <InputLabel
                for="status"
                value="Active"
            />
        </div>

        <!-- Submit -->
        <div>
            <PrimaryButton
                :disabled="form.processing"
            >
                {{ buttonText }}
            </PrimaryButton>
        </div>

    </form>
</template>