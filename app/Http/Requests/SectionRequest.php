<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "section_name" => [
                'required',
                'string',
                'max:50',
                Rule::unique('sections', 'section_name')->ignore($this->id),
            ],
            "description" => ['required','string','max:1000']
        ];
    }

    public function messages(): array
    {
        return [
            'section_name.required' => 'العنوان مطلوب',
            'section_name.max' => 'يجب أن لا يتجاوز العنوان 50 حرفًا',
            'section_name.unique' => 'العنوان موجود بالفعل',
            'section_name.string' => 'يجب أن تكون الرسالة نصًا',
            'description.required' => 'الرسالة مطلوبة',
            'description.max' => 'يجب أن لا تتجاوز الرسالة 1000 حرف',
            'description.string' => 'يجب أن تكون الرسالة نصًا'
        ];
    }


}
