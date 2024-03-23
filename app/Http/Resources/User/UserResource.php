<?php

namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Resources\Package\PackageHotelsResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'created_at' => $this->created_at,
        ];

        return $response;
    }

    public function with($request)
    {
        return [
            "success" => true,
            "message" => "",
            "status" => 200
        ];
    } 
}
