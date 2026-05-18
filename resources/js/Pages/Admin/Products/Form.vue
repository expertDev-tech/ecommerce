<script setup>

import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

defineProps({

    form: Object,

    categories: Array,

    brands: Array,

    submit: Function,

    buttonText: {
        type: String,
        default: 'Save',
    },

})

</script>

<template>

    <form
        @submit.prevent="submit"
        class="space-y-8"
    >

        <!-- Basic Information -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                Basic Information
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-6"
            >

                <!-- Category -->
                <div>

                    <InputLabel
                        value="Category"
                    />

                    <select
                        v-model="form.category_id"
                        class="w-full rounded-lg border-gray-300"
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

                <!-- Brand -->
                <div>

                    <InputLabel
                        value="Brand"
                    />

                    <select
                        v-model="form.brand_id"
                        class="w-full rounded-lg border-gray-300"
                    >

                        <option value="">
                            Select Brand
                        </option>

                        <option
                            v-for="brand in brands"
                            :key="brand.id"
                            :value="brand.id"
                        >
                            {{ brand.name }}
                        </option>

                    </select>

                    <InputError
                        :message="form.errors.brand_id"
                        class="mt-2"
                    />

                </div>

                <!-- Name -->
                <div>

                    <InputLabel
                        value="Product Name"
                    />

                    <TextInput
                        v-model="form.name"
                        class="mt-1 block w-full"
                    />

                    <InputError
                        :message="form.errors.name"
                        class="mt-2"
                    />

                </div>

                <!-- SKU -->
                <div>

                    <InputLabel
                        value="SKU"
                    />

                    <TextInput
                        v-model="form.sku"
                        class="mt-1 block w-full"
                    />

                    <InputError
                        :message="form.errors.sku"
                        class="mt-2"
                    />

                </div>

                <!-- Barcode -->
                <div>

                    <InputLabel
                        value="Barcode"
                    />

                    <TextInput
                        v-model="form.barcode"
                        class="mt-1 block w-full"
                    />

                </div>

                <!-- Weight -->
                <div>

                    <InputLabel
                        value="Weight"
                    />

                    <TextInput
                        type="number"
                        step="0.01"
                        v-model="form.weight"
                        class="mt-1 block w-full"
                    />

                </div>

            </div>

        </div>

        <!-- Pricing -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                Pricing
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-6"
            >

                <!-- Price -->
                <div>

                    <InputLabel
                        value="Price"
                    />

                    <TextInput
                        type="number"
                        step="0.01"
                        v-model="form.price"
                        class="mt-1 block w-full"
                    />

                    <InputError
                        :message="form.errors.price"
                        class="mt-2"
                    />

                </div>

                <!-- Sale Price -->
                <div>

                    <InputLabel
                        value="Sale Price"
                    />

                    <TextInput
                        type="number"
                        step="0.01"
                        v-model="form.sale_price"
                        class="mt-1 block w-full"
                    />

                </div>

                <!-- Cost Price -->
                <div>

                    <InputLabel
                        value="Cost Price"
                    />

                    <TextInput
                        type="number"
                        step="0.01"
                        v-model="form.cost_price"
                        class="mt-1 block w-full"
                    />

                </div>

            </div>

        </div>

        <!-- Inventory -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                Inventory
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-6"
            >

                <!-- Stock -->
                <div>

                    <InputLabel
                        value="Stock"
                    />

                    <TextInput
                        type="number"
                        v-model="form.stock"
                        class="mt-1 block w-full"
                    />

                </div>

                <!-- Published At -->
                <div>

                    <InputLabel
                        value="Published At"
                    />

                    <TextInput
                        type="datetime-local"
                        v-model="form.published_at"
                        class="mt-1 block w-full"
                    />

                </div>

            </div>

            <!-- Checkboxes -->
            <div
                class="flex flex-wrap gap-6 mt-6"
            >

                <label
                    class="flex items-center gap-2"
                >

                    <input
                        type="checkbox"
                        v-model="form.manage_stock"
                    >

                    Manage Stock

                </label>

                <label
                    class="flex items-center gap-2"
                >

                    <input
                        type="checkbox"
                        v-model="form.in_stock"
                    >

                    In Stock

                </label>

                <label
                    class="flex items-center gap-2"
                >

                    <input
                        type="checkbox"
                        v-model="form.is_featured"
                    >

                    Featured

                </label>

                <select
                    v-model="form.status"
                    class="rounded-lg border-gray-300"
                >

                    <option value="draft">
                        Draft
                    </option>

                    <option value="active">
                        Active
                    </option>

                    <option value="inactive">
                        Inactive
                    </option>

                    <option value="archived">
                        Archived
                    </option>

                </select>

            </div>

        </div>

        <!-- Thumbnail -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                Thumbnail
            </h2>

            <input
                type="file"
                @input="form.thumbnail = $event.target.files[0]"
            />

            <InputError
                :message="form.errors.thumbnail"
                class="mt-2"
            />

        </div>

        <!-- Description -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                Description
            </h2>

            <div class="space-y-6">

                <div>

                    <InputLabel
                        value="Short Description"
                    />

                    <textarea
                        v-model="form.short_description"
                        rows="3"
                        class="w-full rounded-lg border-gray-300"
                    />

                </div>

                <div>

                    <InputLabel
                        value="Description"
                    />

                    <textarea
                        v-model="form.description"
                        rows="6"
                        class="w-full rounded-lg border-gray-300"
                    />

                </div>

            </div>

        </div>

        <!-- SEO -->
        <div
            class="bg-gray-50 p-6 rounded-xl border"
        >

            <h2
                class="text-lg font-semibold mb-6"
            >
                SEO
            </h2>

            <div class="space-y-6">

                <div>

                    <InputLabel
                        value="Meta Title"
                    />

                    <TextInput
                        v-model="form.meta_title"
                        class="mt-1 block w-full"
                    />

                </div>

                <div>

                    <InputLabel
                        value="Meta Description"
                    />

                    <textarea
                        v-model="form.meta_description"
                        rows="4"
                        class="w-full rounded-lg border-gray-300"
                    />

                </div>

            </div>

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