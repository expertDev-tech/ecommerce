<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeRequest extends FormRequest
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
        $attributeId = $this->route('attribute')?->id;

        return [

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'max:255',
            ],

            'type' => [
                'required',
                'in:text,textarea,number,select,radio,checkbox,color,date',
            ],

            'options' => [
                'nullable',
                'array',
            ],

            'options.*.label' => [
                'required',
                'string',
                'max:255',
            ],

            'options.*.value' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_filterable' => [
                'required',
                'boolean',
            ],

            'is_required' => [
                'required',
                'boolean',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ];
    }
}
