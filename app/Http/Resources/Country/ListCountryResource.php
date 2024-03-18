<?php

namespace App\Http\Resources\Country;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ListCountryResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($data) {
            if ($data->image != '') {
                $image = url('storage/app/public/images/country', $data->image);
            } else {
                $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
            }
            return [
                'id' => $data->id,
                'name' => $data->name,
                'symbol' => $data->symbol,
                'start_price' => $data->start_price,
                'country_order' => $data->country_order,
                'image' => $image
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
