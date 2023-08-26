<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "invoice_number",
        "invoice_date",
        "due_date",
        "product",
        'amount_collection',
        'amount_commission',
        "discount",
        "rate_vat",
        "value_vat",
        "total",
        "note",
        "value_status",
        'payment_date',
        'section_id',
        "user_id",
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
