<?php

namespace App\Http\Resources\Visa;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $image,
        ];

        return $response;
    }
}
