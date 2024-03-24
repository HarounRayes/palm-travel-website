<?php

namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListPackageHotelPricingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "package_id" => $this->package_id,
            "package_hotel_id" => $this->package_hotel_id,
            "hotel_id" => $this->hotel_id,
            "cost" => $this->cost,
            "value" => $this->value,
        ];
    }
}
