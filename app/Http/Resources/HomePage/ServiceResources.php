<?php

namespace App\Http\Resources\HomePage;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResources extends JsonResource
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
            'icon' => url('storage/app/public/images/service/' . $this->icon),
            'title' => $this->title,
            'text' => $this->text,
        ];

        return $response;
    }

}
