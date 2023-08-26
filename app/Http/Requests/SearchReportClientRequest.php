<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchReportClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
        'section' => 'required',
        'product' => 'required',
        'invoice_date_start' => 'bail|nullable|date',
        'invoice_date_end' => 'bail|nullable|date|after:invoice_date_start',
        ];
    }

    public function messages(): array
    {
        return [
            'section.required' => 'حقل القسم مطلوب.',
            'product.required' => 'حقل المنتج مطلوب.',
            'invoice_date_start.date' => 'حقل تاريخ البداية يجب أن يكون تاريخًا صحيحًا.',
            'invoice_date_end.date' => 'حقل تاريخ النهاية يجب أن يكون تاريخًا صحيحًا.',
            'invoice_date_end.after' => 'حقل تاريخ النهاية يجب أن يكون تاريخًا بعد تاريخ البداية.',
        ];
    }
}
