<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('category')?->id;

        return [

            'parent_id' => 'nullable|exists:categories,id',

            'name' => 'required|max:255',

            'slug' => 'required|max:255|unique:categories,slug,' . $categoryId,

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'description' => 'nullable',

            'sort_order' => 'nullable|integer',

            'show_in_menu' => 'required|boolean',

            'status' => 'required|boolean',
        ];
    }
}
