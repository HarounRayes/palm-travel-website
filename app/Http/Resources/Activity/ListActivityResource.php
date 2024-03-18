<?php

namespace App\Http\Resources\Activity;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ListActivityResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                if ($data->image != '') {
                    $image = url('storage/app/public/images/activity', $data->image);
                } else {
                    $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                }
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'symbol' => $data->symbol,
                    'image' => $image,
                    'price' => $data->price,
                    'flight' => $data->flight ? 1 : 0,
                    'hotels' => $data->hotels ? 1 : 0,
                    'transfer' => $data->transfer ? 1 : 0,
                    'activity' => $data->activity ? 1 : 0,
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
