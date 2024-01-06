<?php

namespace App\Http\Resources\HomePage;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResources extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'image' => url('storage/app/public/images/slider/' . $this->image),
            'link' => $this->link
        ];

        return $response;
    }

}
