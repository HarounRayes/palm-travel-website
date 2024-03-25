<?php

namespace App\Http\Resources\User;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Resources\Package\PackageHotelsResource;

class EnquiriesResource extends JsonResource
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
            'num_room' => $this->num_room,
            'message' => $this->message,
            'cost' => $this->cost,
            'is_paid' => $this->is_paid,
            'is_enquiry' => $this->is_enquiry,
            'package_name' => $this->package->name,
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
