<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    attribute: Object,
    attributes: Array,
    categories: Array,
})

const form = useForm({
    category_id: props.attribute.category_id,
    name: props.attribute.name,
    type: props.attribute.type,
    is_filterable: props.attribute.is_filterable,
    is_required: props.attribute.is_required,
    status: props.attribute.status,
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            is_filterable: data.is_filterable ? 1 : 0,
            is_required: data.is_required ? 1 : 0,
            status: data.status ? 1 : 0,
            _method: 'put',
        }))
        .post(
            route('attributes.update', props.attribute.id),
            {
                forceFormData: true,
            }
        )
}
</script>

<template>

    <Head title="Edit Attribute" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Edit Attribute
            </h1>

            <Form
                :form="form"
                :categories="categories"
                :attributes="attributes"
                :submit="submit"
                button-text="Update Attribute"
            />

        </div>

    </AdminLayout>

</template>