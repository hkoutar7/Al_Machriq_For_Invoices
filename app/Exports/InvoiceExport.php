<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{
    public function collection()
    {
        return Invoice::select('invoice_number', 'invoice_date','due_date','product','section_id','amount_collection','amount_commission','discount','rate_vat','value_vat','total','note','value_status','payment_date')->get();
    }
}
