<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    brand: Object,
    brands: Array,
})

const form = useForm({
    name: props.brand.name,
    slug: props.brand.slug,
    logo: null,
    description: props.brand.description,
    status: props.brand.status,
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            status: data.status ? 1 : 0,
            _method: 'put',
        }))
        .post(
            route('brands.update', props.brand.id),
            {
                forceFormData: true,
            }
        )
}
</script>

<template>

    <Head title="Edit Brand" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Edit Brand
            </h1>

            <!-- Current Image -->
            <div
                v-if="brand.logo"
                class="mb-6"
            >
                <img
                    :src="`/storage/${brand.logo}`"
                    class="w-32 h-32 rounded object-cover border"
                />
            </div>

            <Form
                :form="form"
                :brands="brands"
                :submit="submit"
                button-text="Update Category"
            />

        </div>

    </AdminLayout>

</template>