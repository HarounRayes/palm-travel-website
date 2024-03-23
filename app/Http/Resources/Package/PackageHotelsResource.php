<?php

namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PackageHotelsResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($data) {
            if ($data->image != '') {
                $image = url('storage/app/public/images/hotel', $data->image);
            } else {
                $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
            }

            return [
                'id' => $data->id,
                'name' => $data->name,
                'info' => $data->info,
                'website_link' => $data->website_link,
                'image' => $image,
                'check_in' => $data->check_in,
                'check_out' => $data->check_out,
                "room_details" => $data->room_details,
            ];
        });
    }

    public function with($data)
    {
        return [
            "success" => true,
            "message" => "",
            "status" => 200
        ];
    }
}
