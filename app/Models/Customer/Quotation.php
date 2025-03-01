<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'quotation_number',
        'customer_id',
        'site_id',
        'date',
        'sub_total',
        'discount',
        'discount_type',
        'vat',
        'total',
        'description',
        'remarks',
    ];
}
