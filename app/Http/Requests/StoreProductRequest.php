<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:60' ,
            "section_id" => 'required|numeric' ,
            "description" => 'nullable|string'
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'حقل اسم المنتج مطلوب.',
            'product_name.string' => 'حقل اسم المنتج يجب أن يكون نصًا.',
            'product_name.max' => 'حقل اسم المنتج يجب ألا يتجاوز 60 حرفًا.',
            'section_id.required' => 'يجب اختيار قسم مناسب من البنوك.',
            'section_id.numeric' => 'حقل القسم يجب أن يكون رقمًا.',
            'description.string' => 'حقل الوصف يجب أن يكون نصًا.',
        ];
    }

}
