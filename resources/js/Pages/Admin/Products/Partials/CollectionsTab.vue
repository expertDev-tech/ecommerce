<script setup>

import {
    useForm,
} from '@inertiajs/vue3'

const props = defineProps({

    product: Object,

    collections: Array,

})

const form = useForm({

    collections:
        props.product.collections?.map(
            collection => collection.id
        ) || [],

})

const submit = () => {

    form.post(

        route(
            'products.collections.store',
            props.product.id
        ),

        {
            preserveScroll: true,
        }

    )

}

</script>

<template>

    <div class="space-y-6">

        <!-- Header -->

        <div
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
        >

            <h2
                class="text-xl font-semibold text-gray-800"
            >
                Product Collections
            </h2>

            <p
                class="text-gray-500 mt-1"
            >
                Assign this product to one or more collections.
            </p>

        </div>

        <!-- Collections -->

        <div
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
        >

            <div
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"
            >

                <label
                    v-for="collection in collections"
                    :key="collection.id"
                    class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition"
                >

                    <input
                        type="checkbox"
                        :value="collection.id"
                        v-model="form.collections"
                        class="rounded border-gray-300"
                    >

                    <div>

                        <div
                            class="font-medium text-gray-800"
                        >
                            {{ collection.name }}
                        </div>

                        <!-- <div
                            v-if="collection.description"
                            class="text-sm text-gray-500"
                        >
                            {{ collection.description }}
                        </div> -->

                    </div>

                </label>

            </div>

            <!-- Button -->

            <div
                class="mt-6"
            >

                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium"
                >
                    Save Collections
                </button>

            </div>

        </div>

    </div>

</template>