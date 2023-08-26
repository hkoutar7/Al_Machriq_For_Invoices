<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_number' => 'required|string|max:100|unique:invoices',
            'invoice_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'section' => 'required|integer|min:0',
            'product' => 'required|string|max:49',
            'amount_collection' => 'required|numeric|min:0',
            'amount_commission' => 'required|numeric|gte:amount_collection',
            'discount' => 'required|numeric|min:0',
            'rate_vat' => ['required', 'string'],
            'value_vat' => 'required|numeric|min:0',
            'total' => 'required|numeric|gte:value_vat',
            'note' => 'nullable|string',
            'media' => 'nullable|mimes:jpg,png,pdf',
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.required' => 'حقل رقم الفاتورة مطلوب.',
            'invoice_number.string' => 'حقل رقم الفاتورة يجب أن يكون نصًا.',
            'invoice_number.max' => 'حقل رقم الفاتورة يجب أن لا يتجاوز 100 حرف.',
            'invoice_number.unique' => 'رقم الفاتورة موجود مسبقًا.',

            'invoice_date.required' => 'حقل تاريخ الفاتورة مطلوب.',
            'invoice_date.date' => 'حقل تاريخ الفاتورة يجب أن يكون تاريخًا صالحًا.',
            'invoice_date.after_or_equal' => 'حقل تاريخ الفاتورة يجب أن يكون بعد أو يساوي تاريخ اليوم.',

            'due_date.required' => 'حقل تاريخ الاستحقاق مطلوب.',
            'due_date.date' => 'حقل تاريخ الاستحقاق يجب أن يكون تاريخًا صالحًا.',
            'due_date.after_or_equal' => 'حقل تاريخ الاستحقاق يجب أن يكون بعد أو يساوي تاريخ الفاتورة.',

            'section.required' => 'حقل القسم مطلوب.',
            'section.integer' => 'حقل القسم يجب أن يكون رقمًا صحيحًا.',
            'section.min' => 'حقل القسم يجب أن لا يكون أقل من 0.',

            'product.required' => 'حقل المنتج مطلوب.',
            'product.string' => 'حقل المنتج يجب أن يكون نصًا.',
            'product.max' => 'حقل المنتج يجب أن لا يتجاوز 49 حرف.',

            'amount_collection.required' => 'حقل مبلغ التحصيل مطلوب.',
            'amount_collection.numeric' => 'حقل مبلغ التحصيل يجب أن يكون رقمًا.',
            'amount_collection.min' => 'حقل مبلغ التحصيل يجب أن لا يكون أقل من 0.',

            'amount_commission.required' => 'حقل مبلغ العمولة مطلوب.',
            'amount_commission.numeric' => 'حقل مبلغ العمولة يجب أن يكون رقمًا.',
            'amount_commission.gte' => 'حقل مبلغ العمولة يجب أن يكون أكبر من أو يساوي مبلغ التحصيل.',

            'discount.required' => 'حقل الخصم مطلوب.',
            'discount.numeric' => 'حقل الخصم يجب أن يكون رقمًا.',
            'discount.min' => 'حقل الخصم يجب أن لا يكون أقل من 0.',

            'rate_vat.required' => 'حقل معدل ضريبة القيمة المضافة مطلوب.',
            'rate_vat.string' => 'حقل معدل ضريبة القيمة المضافة يجب أن يكون نصًا.',

            'value_vat.required' => 'حقل قيمة ضريبة القيمة المضافة مطلوب.',
            'value_vat.numeric' => 'حقل قيمة ضريبة القيمة المضافة يجب أن يكون رقمًا.',
            'value_vat.min' => 'حقل قيمة ضريبة القيمة المضافة يجب أن لا يكون أقل من 0.',

            'total.required' => 'حقل المجموع مطلوب.',
            'total.numeric' => 'حقل المجموع يجب أن يكون رقمًا.',
            'total.gte' => 'حقل المجموع يجب أن يكون أكبر من أو يساوي قيمة ضريبة القيمة المضافة.',

            'note.string' => 'حقل الملاحظة يجب أن يكون نصًا.',

            'media.mimes' => 'نوع الملف يجب أن يكون JPG أو PNG أو PDF.',
        ];
    }



}
