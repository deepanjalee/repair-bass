<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceExpense extends Model
{
    use HasFactory;
      protected $fillable = [
        'invoice_id',
        'name',
        'price',
        'description',
    ];
}
