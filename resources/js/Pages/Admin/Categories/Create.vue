<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    categories: Array,
})

const form = useForm({
    parent_id: null,
    name: '',
    slug: '',
    image: null,
    description: '',
    sort_order: 0,
    show_in_menu: true,
    status: true,
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            show_in_menu: data.show_in_menu ? 1 : 0,
            status: data.status ? 1 : 0,
        }))
        .post(route('categories.store'))
}
</script>

<template>

    <Head title="Create Category" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Create Category
            </h1>

            <Form
                :form="form"
                :categories="categories"
                :submit="submit"
                button-text="Create Category"
            />

        </div>

    </AdminLayout>

</template>