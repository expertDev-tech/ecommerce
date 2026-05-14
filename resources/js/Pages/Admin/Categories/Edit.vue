<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Form from './Form.vue'

import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    category: Object,
    categories: Array,
})

const form = useForm({
    parent_id: props.category.parent_id,
    name: props.category.name,
    slug: props.category.slug,
    image: null,
    description: props.category.description,
    sort_order: props.category.sort_order,
    show_in_menu: props.category.show_in_menu,
    status: props.category.status,
})

const submit = () => {

    form
        .transform((data) => ({
            ...data,
            show_in_menu: data.show_in_menu ? 1 : 0,
            status: data.status ? 1 : 0,
            _method: 'put',
        }))
        .post(
            route('categories.update', props.category.id),
            {
                forceFormData: true,
            }
        )
}
</script>

<template>

    <Head title="Edit Category" />

    <AdminLayout>

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-6">
                Edit Category
            </h1>

            <!-- Current Image -->
            <div
                v-if="category.image"
                class="mb-6"
            >
                <img
                    :src="`/storage/${category.image}`"
                    class="w-32 h-32 rounded object-cover border"
                />
            </div>

            <Form
                :form="form"
                :categories="categories"
                :submit="submit"
                button-text="Update Category"
            />

        </div>

    </AdminLayout>

</template>