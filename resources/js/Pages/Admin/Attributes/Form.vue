<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    form: Object,
    categories: Array,
    attributes: Array,
    submit: Function,
    buttonText: {
        type: String,
        default: 'Save',
    },
})

const addOption = () => {

    props.form.options.push({

        label: '',

        value: '',

    })

}

const removeOption = (index) => {

    props.form.options.splice(index, 1)

}
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

        <!-- Options -->
        <div
            v-if="[
                'select',
                'radio',
                'checkbox',
                'color',
            ].includes(form.type)"
        >

            <InputLabel
                value="Options"
            />

            <div
                class="space-y-3 mt-3"
            >

                <div
                    v-for="(option, index) in form.options"
                    :key="index"
                    class="flex gap-3"
                >

                    <!-- Label -->
                    <input
                        v-model="option.label"
                        type="text"
                        placeholder="Label"
                        class="w-full rounded-xl border-gray-300"
                    />

                    <!-- Value -->
                    <input
                        v-model="option.value"
                        type="text"
                        placeholder="Value"
                        class="w-full rounded-xl border-gray-300"
                    />

                    <!-- Remove -->
                    <button
                        type="button"
                        @click="removeOption(index)"
                        class="px-3 rounded-lg bg-red-100 text-red-600"
                    >
                        X
                    </button>

                </div>

            </div>

            <!-- Add -->
            <button
                type="button"
                @click="addOption"
                class="mt-4 px-4 py-2 rounded-lg bg-indigo-600 text-white"
            >
                + Add Option
            </button>

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