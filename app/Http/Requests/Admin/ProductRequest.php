<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'brand_id' => [
                'required',
                'exists:brands,id',
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'sku' => [

                'required',

                'string',

                Rule::unique('products', 'sku')
                    ->ignore(
                        $this->route('product')->id
                    ),

            ],

            'barcode' => [
                'nullable',
                'max:255',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'cost_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'weight' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'short_description' => [
                'nullable',
            ],

            'description' => [
                'nullable',
            ],

            'meta_title' => [
                'nullable',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
            ],

            'manage_stock' => [
                'boolean',
            ],

            'in_stock' => [
                'boolean',
            ],

            'is_featured' => [
                'boolean',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'active',
                    'inactive',
                    'archived',
                ]),
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ];
    }
}
