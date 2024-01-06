<?php

namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListPackageResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                if ($data->image != '') {
                    $image = url('storage/app/public/images/package', $data->image);
                } else {
                    $image = '';
                }
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'symbol' => $data->symbol,
                    'image' => $image,
                    'labels' => PackageLabelResource::collection($data->labels),
                    'flight' => $data->flight ? 1 : 0,
                    'hotels' => $data->hotels ? 1 : 0,
                    'transfer' => $data->transfer ? 1 : 0,
                    'activity' => $data->activity ? 1 : 0,
                    'package_hotels' => PackageHotelResource::collection($data->packageHotels),

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
