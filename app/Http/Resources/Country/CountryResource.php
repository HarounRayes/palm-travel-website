<?php

namespace App\Http\Resources\Country;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CountryResource extends JsonResource
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
            $image = '';
        }
        if ($this->header_image != '') {
            $header_image = url('storage/app/public/images/country', $this->header_image);

        } else {
            $header_image = '';
        }
        if ($this->flag != '' ) {
            $flag = url('storage/app/public/images/country', $this->flag);
        } else {
            $flag = '';
        }
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'capital' => $this->capital,
            'currency' => $this->currency,
            'convert_currency' => $this->convert_currency,
            'official_lang' => $this->official_lang,
            'visa_info' => $this->visa_info,
            'intro' => $this->intro,
            'symbol' => $this->symbol,
            'start_price' => $this->start_price,
            'country_order' => $this->country_order,
            'image' => $image,
            'flag' => $flag,
            'header_image' => $header_image,
        ];

        return $response;
    }

}
