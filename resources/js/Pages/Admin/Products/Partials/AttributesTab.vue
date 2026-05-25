<script setup>

import {
    useForm,
    router,
} from '@inertiajs/vue3'

const props = defineProps({

    product: Object,

    attributes: Array,

})

/*
|--------------------------------------------------------------------------
| Form
|--------------------------------------------------------------------------
*/

const form = useForm({

    values: {},

})

props.product.attribute_values?.forEach(
    (item) => {

        if (item.attribute.type === 'checkbox') {

            try {

                form.values[item.attribute_id] =
                    JSON.parse(item.value)

            } catch {

                form.values[item.attribute_id] = []

            }

        }

        else {

            form.values[item.attribute_id] =
                item.value

        }

    }
)

props.attributes.forEach((attribute) => {

    if (

        attribute.type === 'checkbox'

        &&

        !form.values[attribute.id]

    ) {

        form.values[attribute.id] = []

    }

    if (

        attribute.type === 'radio'

        &&

        !form.values[attribute.id]

        &&

        attribute.options?.length

    ) {

        form.values[attribute.id] =
            attribute.options[0].value

    }

    if (

        attribute.type === 'select'

        &&

        !form.values[attribute.id]

    ) {

        form.values[attribute.id] = ''

    }

})


const submit = () => {

    for (const attribute of props.attributes) {

        if (!attribute.is_required) {
            continue
        }

        const value =
            form.values[attribute.id]


        if (attribute.type === 'checkbox' && (!value || value.length === 0)) {

            alert(
                `${attribute.name} is required`
            )

            return
        }

        if (value === null|| value === undefined || value === '' ) {

            alert(
                `${attribute.name} is required`
            )

            return
        }

    }

    form.post(
        route(
            'products.attributes.store',
            props.product.id
        ),
        {
            preserveScroll: true,
        }
    )

}

const deleteAttribute = (
    attributeValueId
) => {

    if (
        !confirm(
            'Delete this attribute?'
        )
    ) {
        return
    }

    router.delete(
        route(
            'products.attributes.destroy',
            attributeValueId
        ),
        {
            preserveScroll: true,
        }
    )
}

</script>

<template>

    <div class="space-y-6">

        <!-- Add Attribute -->
        <div
            v-for="attribute in attributes"
            :key="attribute.id"
            class="space-y-2"
        >

            <label class="text-sm font-medium">

                {{ attribute.name }}

                <span
                    v-if="attribute.is_required"
                    class="text-red-500"
                >
                    *
                </span>

            </label>

            <!-- TEXT -->
            <input
                v-if="attribute.type === 'text'"
                v-model="form.values[attribute.id]"
                type="text"
                class="w-full rounded-xl border-gray-300"
            />

            <!-- TEXTAREA -->
            <textarea
                v-else-if="attribute.type === 'textarea'"
                v-model="form.values[attribute.id]"
                rows="4"
                class="w-full rounded-xl border-gray-300"
            />

            <!-- NUMBER -->
            <input
                v-else-if="attribute.type === 'number'"
                v-model="form.values[attribute.id]"
                type="number"
                class="w-full rounded-xl border-gray-300"
            />

            <!-- DATE -->
            <input
                v-else-if="attribute.type === 'date'"
                v-model="form.values[attribute.id]"
                type="date"
                class="rounded-xl border-gray-300"
            />

            <!-- select -->
            <select
                v-else-if="attribute.type === 'select'"
                v-model="form.values[attribute.id]"
                class="w-full rounded-xl border-gray-300"
            >

                <option value="">
                    Select Option
                </option>

                <option
                    v-for="option in attribute.options"
                    :key="option.id"
                    :value="option.value"
                >
                    {{ option.label }}
                </option>

            </select>

            <!-- radio -->
            <div
                v-else-if="attribute.type === 'radio'"
                class="flex flex-wrap gap-4"
            >

                <label
                    v-for="option in attribute.options"
                    :key="option.id"
                    class="flex items-center gap-2"
                >

                    <input
                        type="radio"
                        :value="option.value"
                        v-model="form.values[attribute.id]"
                    >

                    {{ option.label }}

                </label>

            </div>

            <!-- checkbox -->
            <div
                v-else-if="attribute.type === 'checkbox'"
                class="flex flex-wrap gap-4"
            >

                <label
                    v-for="option in attribute.options"
                    :key="option.id"
                    class="flex items-center gap-2"
                >

                    <input
                        type="checkbox"
                        :value="option.value"
                        v-model="form.values[attribute.id]"
                    >

                    {{ option.label }}

                </label>

            </div>

            <!-- color -->
             <div
                v-else-if="attribute.type === 'color'"
                class="flex flex-wrap gap-3"
            >

                <label
                    v-for="option in attribute.options"
                    :key="option.id"
                    class="cursor-pointer"
                >

                    <input
                        type="radio"
                        class="hidden"
                        :value="option.value"
                        v-model="form.values[attribute.id]"
                    >

                    <div
                        class="w-10 h-10 rounded-full border-2"
                        :title="option.label"
                        :style="{
                            backgroundColor:
                                option.value
                        }"
                    ></div>

                </label>

            </div>

        </div>

        <div>
            <button
                @click="submit"
                :disabled="form.processing"
                class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium"
            >
                Save Attributes
            </button>
        </div>

        <!-- List -->
        <div
            class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
        >

            <div
                class="flex items-center justify-between mb-6"
            >

                <h2
                    class="text-xl font-semibold text-gray-800"
                >
                    Product Attribute List
                </h2>

                <span
                    class="text-sm text-gray-500"
                >
                    {{
                        product.attribute_values?.length || 0
                    }}
                    Attributes
                </span>

            </div>

            <!-- Empty -->
            <div
                v-if="!product.attribute_values?.length"
                class="border border-dashed border-gray-300 rounded-2xl py-16 text-center"
            >

                <p class="text-gray-500">
                    No attributes added yet.
                </p>

            </div>

            <!-- Table -->
            <div
                v-else
                class="overflow-x-auto"
            >

                <table
                    class="w-full text-sm"
                >

                    <thead>

                        <tr
                            class="border-b"
                        >

                            <th
                                class="text-left py-3"
                            >
                                Attribute
                            </th>

                            <th
                                class="text-left py-3"
                            >
                                Value
                            </th>

                            <th
                                class="text-right py-3"
                            >
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr
                            v-for="item in product.attribute_values"
                            :key="item.id"
                            class="border-b"
                        >

                            <td class="py-4">
                                {{ item.attribute.name }}
                            </td>

                            <td class="py-4">
                                {{ item.value }}
                            </td>

                            <td
                                class="py-4 text-right"
                            >

                                <button
                                    @click="deleteAttribute(item.id)"
                                    class="text-red-600 hover:text-red-700"
                                >
                                    Delete
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</template>