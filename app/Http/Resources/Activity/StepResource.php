<?php

namespace App\Http\Resources\Activity;


use App\Http\Resources\GeneralInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StepResource extends JsonResource
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
            $image = url('storage/app/public/images/activity', $this->image);
        } else {
            $image = '';
        }
        $response = [
            'name' => $this->name,
            'image' => $image,
        ];

        return $response;
    }
}
