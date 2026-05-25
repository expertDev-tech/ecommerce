<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    categories: Array,
    attributes: Array,
})

const form = useForm({
    category_id: null,
    name: '',
    type: 'text',
    is_filterable: true,
    is_required: true,
    status: true,
    options: [],
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            is_filterable: data.is_filterable ? 1 : 0,
            is_required: data.is_required ? 1 : 0,
            status: data.status ? 1 : 0,
        }))
        .post(route('attributes.store'))
}

</script>

<template>

    <Head title="Create Attribute" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Create Attribute
            </h1>

            <Form
                :form="form"
                :categories="categories"
                :attributes="attributes"
                :submit="submit"
                button-text="Create Attribute"
            />

        </div>

    </AdminLayout>

</template>