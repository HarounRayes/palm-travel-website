<?php

namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Resources\Package\PackageHotelsResource;

class FavoritesResource extends JsonResource
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
            'package_id' => $this->package->id,
            'package_name' => $this->package->name,
            'paid' => $this->paid,
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
