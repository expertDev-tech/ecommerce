<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import Form from './Form.vue'

import {
    Head,
    useForm,
} from '@inertiajs/vue3'

const form = useForm({

    name: '',

    image: null,

    description: '',

    meta_title: '',

    meta_description: '',

    is_featured: false,

    status: true,

})

const submit = () => {

    form.post(
        route('collections.store'),
        {
            forceFormData: true,
        }
    )
}

</script>

<template>

    <Head title="Create Collection" />

    <AdminLayout>

        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
        >

            <div
                class="mb-6"
            >

                <h1
                    class="text-3xl font-bold text-gray-800"
                >
                    Create Collection
                </h1>

                <p
                    class="text-gray-500 mt-1"
                >
                    Create a new product collection.
                </p>

            </div>

            <Form
                :form="form"
                :submit="submit"
                button-text="Create Collection"
            />

        </div>

    </AdminLayout>

</template>