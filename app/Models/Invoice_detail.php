<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'product',
        'section',
        'value_Status',
        'payment_date',
        'note',
        'created_by',
        'invoice_id'
    ];



}
