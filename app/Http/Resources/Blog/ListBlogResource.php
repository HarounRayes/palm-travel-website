<?php

namespace App\Http\Resources\Blog;

use App\GeneralInformation;
use App\Http\Resources\GeneralInfoResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListBlogResource extends ResourceCollection
{
    public function toArray($request)
    {
        $info = GeneralInformation::where('type', 'blog')->firstOrFail();
        if ($info->image != '') {
            $info_header_image = url('storage/images/info/', $info->image);
        } else {
            $info_header_image = '';
        }
        return [
            'data' => $this->collection->map(function ($data) {
                if ($data->image != '') {
                    $image = url('storage/app/public/images/blog', $data->image);
                } else {
                    $image = '';
                }
                if ($data->header_image != '') {
                    $header_image = url('storage/app/public/images/blog', $data->header_image);
                } else {
                    $header_image = '';
                }
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'info' => $data->info,
                    'symbol' => $data->symbol,
                    'image' => $image,
                    'header_image' => $header_image,
                    'slider' => BlogSliderResource::collection($data->sliders),

                ];
            }),
            'global_info' => [
                'intro' => $info->intro,
                'header_image' => $info_header_image,
            ]
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
