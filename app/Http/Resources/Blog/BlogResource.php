<?php

namespace App\Http\Resources\Blog;


use App\Http\Resources\GeneralInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BlogResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->image != '') {
            $image = url('storage/app/public/images/blog', $this->image);
        } else {
            $image = '';
        }
        if ($this->header_image != '') {
            $header_image = url('storage/app/public/images/blog', $this->header_image);
        } else {
            $header_image = '';
        }
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'info' => $this->info,
            'symbol' => $this->symbol,
            'image' => $image,
            'header_image' => $header_image,
         //   'slider' => BlogSliderResource::collection($this->sliders),
            'comments' => BlogCommentResource::collection($this->comments)
        ];

        return $response;
    }
}
