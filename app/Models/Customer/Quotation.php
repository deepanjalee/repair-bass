<?php

namespace App\Models\Customer;

use App\Models\Admin\Customer;
use App\Models\Admin\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'discount_percentage',
        'discount_type',
        'vat',
        'total',
        'description',
        'remarks',
    ];

    public static function generateNextQuotationNumber()
    {
        $latestQuotation = self::orderBy('quotation_number', 'desc')->first();


        if ($latestQuotation) {
            $lastNumber = (int) $latestQuotation->id;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 100;
        }
        return 'Q' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    public function items(): HasMany 
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}

