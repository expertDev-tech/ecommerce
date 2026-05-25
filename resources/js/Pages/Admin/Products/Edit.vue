<script setup>

import { ref } from 'vue'

import AdminLayout from '@/Layouts/AdminLayout.vue'

import Form from './Form.vue'

import ImagesTab from './Partials/ImagesTab.vue'

import {
    Head,
    useForm,
} from '@inertiajs/vue3'

const props = defineProps({

    product: Object,

    categories: Array,

    brands: Array,

})

/*
|--------------------------------------------------------------------------
| Tabs
|--------------------------------------------------------------------------
*/

const activeTab = ref(
    'basic'
)

/*
|--------------------------------------------------------------------------
| Product Form
|--------------------------------------------------------------------------
*/

const form = useForm({

    category_id:
        props.product.category_id,

    brand_id:
        props.product.brand_id,

    name:
        props.product.name,

    sku:
        props.product.sku,

    barcode:
        props.product.barcode,

    price:
        props.product.price,

    sale_price:
        props.product.sale_price,

    cost_price:
        props.product.cost_price,

    stock:
        props.product.stock,

    weight:
        props.product.weight,

    manage_stock:
        props.product.manage_stock,

    in_stock:
        props.product.in_stock,

    short_description:
        props.product.short_description,

    description:
        props.product.description,

    meta_title:
        props.product.meta_title,

    meta_description:
        props.product.meta_description,

    is_featured:
        props.product.is_featured,

    status:
        props.product.status,

    published_at:
        props.product.published_at,

})

/*
|--------------------------------------------------------------------------
| Submit
|--------------------------------------------------------------------------
*/

const submit = () => {

    form
        .transform((data) => ({

            ...data,

            _method: 'put',

        }))
        .post(
            route(
                'products.update',
                props.product.id
            ),
            {
                forceFormData: true,
            }
        )
}

</script>

<template>

    <Head title="Edit Product" />

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
                        Edit Product
                    </h1>

                    <p
                        class="text-gray-500 mt-1"
                    >
                        Manage product information and advanced product modules.
                    </p>

                </div>

            </div>

            <!-- Tabs -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 flex gap-2 overflow-x-auto"
            >

                <!-- Basic Info -->
                <button
                    @click="activeTab = 'basic'"
                    class="px-5 py-2 rounded-xl font-medium transition"
                    :class="

                        activeTab === 'basic'
                            ? 'bg-indigo-600 text-white'
                            : 'text-gray-600 hover:bg-gray-100'

                    "
                >
                    Basic Info
                </button>

                <!-- Images -->
                <button
                    @click="activeTab = 'images'"
                    class="px-5 py-2 rounded-xl font-medium transition"
                    :class="

                        activeTab === 'images'
                            ? 'bg-indigo-600 text-white'
                            : 'text-gray-600 hover:bg-gray-100'

                    "
                >
                    Images
                </button>

            </div>

            <!-- Basic Info Tab -->
            <div v-if="activeTab === 'basic'">

                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
                >

                    <Form
                        :form="form"
                        :categories="categories"
                        :brands="brands"
                        :submit="submit"
                        :is-edit="true"
                        button-text="Update Product"
                    />

                </div>

            </div>

            <!-- Images Tab -->
            <div v-if="activeTab === 'images'">

                <ImagesTab
                    :product="product"
                />

            </div>

        </div>

    </AdminLayout>

</template>