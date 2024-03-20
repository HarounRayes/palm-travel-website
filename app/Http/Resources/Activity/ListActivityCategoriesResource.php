<?php

namespace App\Http\Resources\Activity;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ListActivityCategoriesResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            "data" => $this->collection->map(function ($data) {
                return [
                    "id" => $data->id,
                    "activity_tour_id"=> $data->activity_tour_id,
                    "activity_category_id" => $data->acos_category_id,
                    "type" => $data->type,
                    "adult_price" => $data->adult_price,
                    "infant_price" => $data->infant_price,
                    "child_3_5_price" => $data->child_3_5_price,
                    "child_6_11_price" => $data->child_6_11_price,
                    "person_1_4_price" => $data->person_1_4_price,
                    "person_1_8_price" => $data->person_1_8_price,
                    "person_1_12_price" => $data->person_1_12_price,
                    "shared_note" => $data->shared_note,
                    "private_is_shared" => $data->private_is_shared,
                    "private_note" => $data->private_note,
                ];
            })
        ];
    }
}
