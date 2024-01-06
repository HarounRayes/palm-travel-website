<?php

namespace App\Http\Resources\Visa;

use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
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
            $image = url('storage/app/public/images/visa', $this->image);
        } else {
            $image = '';
        }
        if ($this->header_image != '') {
            $header_image = url('storage/app/public/images/visa', $this->header_image);
        } else {
            $header_image = '';
        }
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'header_image' => $header_image,
            'image' => $image,
        ];

        return $response;
    }
}
