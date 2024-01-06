<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageTransferResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->type,
            'image' => url('img/' . $this->image),
            'pickup_location' => $this->pickup_location,
            'drop_off_location' => $this->drop_off_location,
            'date' => $this->date ? date("d-m-Y", strtotime($this->date)) : "00-00-0000",
            'time' => $this->time
        ];
    }
}
