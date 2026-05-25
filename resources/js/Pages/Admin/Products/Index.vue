<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import {

    Head,
    Link,
    router,

} from '@inertiajs/vue3'

import { reactive } from 'vue'

const props = defineProps({

    products: Object,

    categories: Array,

    brands: Array,

    filters: Object,

})

const filterForm = reactive({

    search: props.filters.search || '',

    category_id:
        props.filters.category_id || '',

    brand_id:
        props.filters.brand_id || '',

    status:
        props.filters.status || 'draft',

})

const filter = () => {

    router.get(
        route('products.index'),
        filterForm,
        {
            preserveState: true,
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <Head title="Products" />

    <AdminLayout>

        <div class="space-y-6">

            <!-- Header -->
            <div
                class="flex items-center justify-between"
            >

                <div>

                    <h1
                        class="text-3xl font-bold text-gray-800"
                    >
                        Products
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Manage ecommerce products.
                    </p>

                </div>

                <Link
                    :href="route('products.create')"
                    class="px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition"
                >
                    + Add Product
                </Link>

            </div>

            <!-- Filters -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
            >

                <div
                    class="grid grid-cols-1 md:grid-cols-4 gap-4"
                >

                    <!-- Search -->
                    <input
                        v-model="filterForm.search"
                        type="text"
                        placeholder="Search product..."
                        class="rounded-lg border-gray-300"
                    />

                    <!-- Category -->
                    <select
                        v-model="filterForm.category_id"
                        class="rounded-lg border-gray-300"
                    >

                        <option value="">
                            All Categories
                        </option>

                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.label }}
                        </option>

                    </select>

                    <!-- Brand -->
                    <select
                        v-model="filterForm.brand_id"
                        class="rounded-lg border-gray-300"
                    >

                        <option value="">
                            All Brands
                        </option>

                        <option
                            v-for="brand in brands"
                            :key="brand.id"
                            :value="brand.id"
                        >
                            {{ brand.name }}
                        </option>

                    </select>

                    <!-- Status -->
                    <select
                        v-model="filterForm.status"
                        class="rounded-lg border-gray-300"
                    >

                        <option value="">
                            All Status
                        </option>

                        <option :value="draft">
                            Draft
                        </option>

                        <option :value="active">
                            Active
                        </option>

                        <option :value="inactive">
                            Inactive
                        </option>

                        <option :value="archived">
                            Archived
                        </option>

                    </select>

                </div>

                <!-- Filter Button -->
                <div class="mt-4">

                    <button
                        @click="filter"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition"
                    >
                        Apply Filters
                    </button>

                </div>

            </div>

            <!-- Table -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
            >

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead
                            class="bg-gray-50"
                        >

                            <tr>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Image
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Product
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Category
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Brand
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Price
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Stock
                                </th>

                                <th
                                    class="px-6 py-4 text-left text-sm font-semibold text-gray-600"
                                >
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr
                                v-for="product in products.data"
                                :key="product.id"
                                class="border-b border-gray-100 hover:bg-gray-50 transition"
                            >

                                <!-- Image -->
                                <td
                                    class="px-6 py-4"
                                >

                                    <img
                                        v-if="product.primary_image"
                                        :src="`/storage/${product.primary_image.image}`"
                                        class="w-14 h-14 rounded-xl object-cover"
                                    />

                                    <div
                                        v-else
                                        class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center text-xs text-gray-400"
                                    >
                                        No Image
                                    </div>

                                </td>

                                <!-- Product -->
                                <td
                                    class="px-6 py-4"
                                >

                                    <div
                                        class="font-semibold text-gray-800"
                                    >
                                        {{ product.name }}
                                    </div>

                                    <div
                                        class="text-sm text-gray-500"
                                    >
                                        SKU:
                                        {{ product.sku }}
                                    </div>

                                </td>

                                <!-- Category -->
                                <td
                                    class="px-6 py-4"
                                >
                                    {{ product.category?.name }}
                                </td>

                                <!-- Brand -->
                                <td
                                    class="px-6 py-4"
                                >
                                    {{ product.brand?.name }}
                                </td>

                                <!-- Price -->
                                <td
                                    class="px-6 py-4"
                                >

                                    <div
                                        class="font-semibold text-gray-800"
                                    >
                                        ₹{{ product.price }}
                                    </div>

                                    <div
                                        v-if="product.sale_price"
                                        class="text-sm text-red-500"
                                    >
                                        Sale:
                                        ₹{{ product.sale_price }}
                                    </div>

                                </td>

                                <!-- Stock -->
                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        class="px-3 py-1 rounded-lg text-sm font-medium"
                                        :class="

                                            product.stock > 0
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700'

                                        "
                                    >
                                        {{ product.stock }}
                                    </span>

                                </td>

                                <!-- Status -->
                                <td
                                    class="px-6 py-4"
                                >

                                    <span
                                        class="px-3 py-1 rounded-lg text-sm font-medium capitalize"
                                        :class="

                                            {
                                                'bg-yellow-100 text-yellow-700':
                                                    product.status === 'draft',

                                                'bg-green-100 text-green-700':
                                                    product.status === 'active',

                                                'bg-red-100 text-red-700':
                                                    product.status === 'inactive',

                                                'bg-gray-200 text-gray-700':
                                                    product.status === 'archived',
                                            }

                                        "
                                    >
                                        {{ product.status }}
                                    </span>

                                </td>

                            </tr>

                            <!-- Empty -->
                            <tr
                                v-if="products.data.length === 0"
                            >

                                <td
                                    colspan="7"
                                    class="px-6 py-10 text-center text-gray-500"
                                >
                                    No products found.
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </AdminLayout>

</template>