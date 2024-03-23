<?php

namespace App\Http\Resources\Country;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PackageCountryResource extends JsonResource
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
            $image = url('storage/app/public/images/country', $this->image);
        } else {
            $image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
        }
        
        $response = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $response;
    }

}
