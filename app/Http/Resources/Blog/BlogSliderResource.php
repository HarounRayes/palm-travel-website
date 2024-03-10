<?php

namespace App\Http\Resources\Blog;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BlogSliderResource extends JsonResource
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
            $image = url('storage/app/public/images/slider', $this->image);
        } else {
            $image = '';
        }

        $response = [
            'id' => $this->id,
            'text' => $this->text,
            'image' => $image,
        ];

        return $response;
    }

}
