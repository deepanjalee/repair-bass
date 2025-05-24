<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $brand_name = "";
        if($this->brand != null){
            $brand_name  = " - " . $this->brand->name;
        }
        return [
            'id' => $this->id ?? "",
            'name' => $this->name . $brand_name . " - " . $this->length,
            'price' => $this->price ?? "",
        ];
    }
}
