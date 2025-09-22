<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'name',
        'price',
        'description',
    ];
}
