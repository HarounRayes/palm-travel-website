<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneralInfoResource extends JsonResource
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
            $header_image = url('storage/images/info/', $this->image);
        } else {
            $header_image = '';
        }
        $response = [
            'id' => $this->id,
            'intro' => $this->intro,
            'header_image' => $header_image,
        ];

        return $response;
    }
}
