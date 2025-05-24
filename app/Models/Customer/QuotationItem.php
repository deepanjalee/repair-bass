<?php

namespace App\Models\Customer;

use App\Models\Admin\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quotation_id',
        'item_id',
        'price',
        'quantity',
        'total',
        'description',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
