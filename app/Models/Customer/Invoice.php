<?php

namespace App\Models\Customer;

use App\Models\Admin\Customer;
use App\Models\Admin\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'invoice_number',
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
        'quotation_id',
    ];

    public static function generateNextInvoiceNumber()
    {
        $latestInvoice = self::orderBy('id', 'desc')->first();


        if ($latestInvoice) {
            $lastNumber = (int) $latestInvoice->id;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 100;
        }
        // dd('INV' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT) );
        return 'INV' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

      public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
      public function expenses(): HasMany
    {
        return $this->hasMany(InvoiceExpense::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

}
