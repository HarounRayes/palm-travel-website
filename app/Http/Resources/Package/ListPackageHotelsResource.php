<?php

namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListPackageHotelsResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'hotels' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'package_id' => $data->package_id,
                    'price' => $data->price,
                    'check_in' => $data->check_in,
                    'check_out' => $data->check_out,
                    "bookable" => $data->bookable,
                    "enquiry" => $data->enquiry,
                    "sold_out" => $data->sold_out,
                    "room_details" => $data->room_details,
                    'hotel_id' => $data->hotel_id,
                ];

            })
        ];
    }
    public function with($request)
    {
        return [
            "success" => true,
            "message" => "",
            "status" => 200
        ];
    }
}
