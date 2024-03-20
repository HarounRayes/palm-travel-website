<?php

namespace App\Http\Resources\Activity;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Resources\Activity\ListActivityCategoriesResource;


class ListActivitiesDetailResource extends ResourceCollection
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
                    'intro' => $data->intro,
                    'overview' => $data->overview,
                    'price' => $data->price,
                    'date' => $data->date,
                    'private' => $data->private,
                    'shared' => $data->shared,
                    'activity_country_id' => $data->activity_country_id,
                    'activity_city_id' => $data->activity_city_id,
                    'categories' => new ListActivityCategoriesResource($data->categories),
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
