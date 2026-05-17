<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({
    form: Object,
    categories: Array,
    attributes: Array,
    submit: Function,
    buttonText: {
        type: String,
        default: 'Save',
    },
})
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">

        <div>
            <InputLabel for="category_id" value="Category" />

            <select
                v-model="form.category_id"
                class="w-full rounded border-gray-300"
            >
                <option value="">
                    Select Category
                </option>

                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.label }}
                </option>
            </select>

            <InputError
                :message="form.errors.category_id"
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

        <!-- Type -->
        <div>

            <InputLabel
                for="type"
                value="Type"
            />

            <select
                id="type"
                v-model="form.type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >

                <option value="">
                    Select Type
                </option>

                <option value="text">
                    Text
                </option>

                <option value="textarea">
                    Textarea
                </option>

                <option value="number">
                    Number
                </option>

                <option value="select">
                    Select Dropdown
                </option>

                <option value="radio">
                    Radio Button
                </option>

                <option value="checkbox">
                    Checkbox
                </option>

                <option value="color">
                    Color
                </option>

                <option value="date">
                    Date
                </option>

            </select>

            <InputError
                :message="form.errors.type"
                class="mt-2"
            />

        </div>

        <!-- is_filterable -->
        <div class="flex items-center gap-2">

            <input
                type="checkbox"
                id="is_filterable"
                v-model="form.is_filterable"
            />

            <InputLabel
                for="is_filterable"
                value="Filterable"
            />
        </div>

        <!-- is_required -->
        <div class="flex items-center gap-2">

            <input
                type="checkbox"
                id="is_required"
                v-model="form.is_required"
            />

            <InputLabel
                for="is_required"
                value="Required"
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
                value="Status"
            />
        </div>

        <!-- Submit -->
        <div>
            <PrimaryButton
                type="submit"
                :disabled="form.processing"
            >
                {{ buttonText }}
            </PrimaryButton>
        </div>

    </form>
</template>