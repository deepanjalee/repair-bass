<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id' => $this->id,
            'quotation_number' => $this->quotation_number,
            'customer_id' => $this->customer_id,
            'site_id' => intval($this->site_id) ?? '',
            'date' => $this->date,
            'discount' => $this->discount,
            'discount_percentage' => $this->discount_percentage,
            'discount_type' => intval($this->discount_type),
            'vat' => $this->vat,
            'total' => $this->total,
            'description' => $this->description,
            'remarks' => $this->remarks,
            'items' => QuotationItemSelectResource::collection($this->items) ?: [],
        ];
    }
}
