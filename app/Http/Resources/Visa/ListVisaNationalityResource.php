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
                $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
            }

            if ($data->header_image != '') {
                $header_image = url('storage/app/public/images/visa', $data->header_image);
            } else {
                $header_image = 'https://welcome.palmoasistravel.com/storage/app/public/images/info/1667197062.visainfoheaderimagear4.jpg';
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
