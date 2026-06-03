<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue'

import Form from './Form.vue'

import {
    Head,
    useForm,
} from '@inertiajs/vue3'

const props = defineProps({

    collection: Object,

})

const form = useForm({

    name:
        props.collection.name,

    image: null,

    description:
        props.collection.description,

    meta_title:
        props.collection.meta_title,

    meta_description:
        props.collection.meta_description,

    is_featured:
        props.collection.is_featured,

    status:
        props.collection.status,

})

const submit = () => {

    form
        .transform((data) => ({

            ...data,

            _method: 'put',

        }))
        .post(
            route(
                'collections.update',
                props.collection.id
            ),
            {
                forceFormData: true,
            }
        )
}

</script>

<template>

    <Head title="Edit Collection" />

    <AdminLayout>

        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
        >

            <div class="mb-6">

                <h1
                    class="text-3xl font-bold text-gray-800"
                >
                    Edit Collection
                </h1>

                <p
                    class="text-gray-500 mt-1"
                >
                    Update collection information.
                </p>

            </div>

            <Form
                :form="form"
                :collection="collection"
                :submit="submit"
                button-text="Update Collection"
            />

        </div>

    </AdminLayout>

</template>