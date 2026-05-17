<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    brands: Array,
})

const form = useForm({
    name: '',
    slug: '',
    logo: null,
    description: '',
    status: true,
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            status: data.status ? 1 : 0,
        }))
        .post(route('brands.store'))
}
</script>

<template>

    <Head title="Create Brand" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Create Brand
            </h1>

            <Form
                :form="form"
                :brands="brands"
                :submit="submit"
                button-text="Create Brand"
            />

        </div>

    </AdminLayout>

</template>