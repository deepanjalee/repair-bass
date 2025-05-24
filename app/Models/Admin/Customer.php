<?php

namespace App\Models\Admin;

use App\Models\Customer\Quotation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'address',
        'description',
    ];
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
