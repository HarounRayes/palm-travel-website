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
            $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        if ($this->header_image != '') {
            $header_image = url('storage/app/public/images/visa', $this->header_image);
        } else {
            $header_image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'text' => $this->text,
            'header_image' => $header_image,
            'image' => $image,
        ];

        return $response;
    }
}
