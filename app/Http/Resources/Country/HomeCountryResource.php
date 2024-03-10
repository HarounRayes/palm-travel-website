<?php

namespace App\Http\Resources\Country;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeCountryResource extends JsonResource
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
            'name' => $this->name,
            'symbol' => $this->symbol,
            'start_price' => $this->start_price,
            'image' =>  url('storage/app/public/images/country', $this->image)
        ];

        return $response;
    }

}
