<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import {
    Head,
    useForm,
} from '@inertiajs/vue3'

const props = defineProps({

    categories: Array,

    brands: Array,

})

const form = useForm({

    category_id: '',

    brand_id: '',

    name: '',

    sku: '',

    barcode: '',

    price: '',

    sale_price: '',

    cost_price: '',

    stock: 0,

    weight: '',

    manage_stock: true,

    in_stock: true,

    short_description: '',

    description: '',

    meta_title: '',

    meta_description: '',

    is_featured: false,

    status: 'draft',

    published_at: '',

})

const submit = () => {

    form.post(
        route('products.store'),
        {
            forceFormData: true,
        }
    )
}

</script>

<template>

    <Head title="Create Product" />

    <AdminLayout>

        <div class="space-y-6">

            <!-- Page Header -->
            <div
                class="flex items-center justify-between"
            >

                <div>

                    <h1
                        class="text-3xl font-bold text-gray-800"
                    >
                        Create Product
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Add a new product to your ecommerce store.
                    </p>

                </div>

            </div>

            <!-- Workflow Information -->
            <div
                class="bg-blue-50 border border-blue-200 rounded-2xl p-6"
            >

                <h2
                    class="text-lg font-semibold text-blue-800"
                >
                    Product Creation Workflow
                </h2>

                <p
                    class="text-sm text-blue-700 mt-2"
                >
                    First create the basic product information.
                    After saving, you will be able to manage:
                </p>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4"
                >

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Product Images
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Product Videos
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Dynamic Attributes
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Product Variants
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Collections
                    </div>

                    <div
                        class="bg-white rounded-xl p-4 border border-blue-100"
                    >
                        Advanced Inventory
                    </div>

                </div>

            </div>

            <!-- Product Form -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
            >

                <Form
                    :form="form"
                    :categories="categories"
                    :brands="brands"
                    :submit="submit"
                    :is-edit="false"
                    button-text="Create Product"
                />

            </div>

        </div>

    </AdminLayout>

</template>