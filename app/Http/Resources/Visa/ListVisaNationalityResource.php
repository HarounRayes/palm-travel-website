<?php

namespace App\Http\Resources\Visa;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListVisaNationalityResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($data) {

            if ($data->image != '') {
                $image = url('storage/app/public/images/visa', $data->image);
            } else {
                $image = '';
            }

            if ($data->header_image != '') {
                $header_image = url('storage/app/public/images/visa', $data->header_image);
            } else {
                $header_image = '';
            }
            
            return [
                'id' => $data->id,
                'name' => $data->name,
                'text' => $data->text,
                'header_image' => $header_image,
                'image' => $image,
            ];
        });
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
