<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:60' ,
            "section_name" => 'required' ,
            "description" => 'nullable|string'
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'حقل اسم المنتج مطلوب.',
            'product_name.string' => 'حقل اسم المنتج يجب أن يكون نصًا.',
            'product_name.max' => 'حقل اسم المنتج يجب ألا يتجاوز 60 حرفًا.',
            'section_name.required' => 'يجب اختيار قسم مناسب من البنوك.',
            'description.string' => 'حقل الوصف يجب أن يكون نصًا.',
        ];
    }
}
