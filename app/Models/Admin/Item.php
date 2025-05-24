<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'length',
        'price',
        'brand_id',
        'description',
    ];

    protected $appends = ['item_name'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
     public function getItemNameAttribute(){
        return  $this->name . " - " .  optional($this->brand)->name . " - " . $this->length;
     }
}
