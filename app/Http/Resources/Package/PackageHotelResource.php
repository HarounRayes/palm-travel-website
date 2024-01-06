<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageHotelResource extends JsonResource
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
            'id' => intval($this->id),
            'sold_out' => $this->sold_out ? 1 : 0,
            'star_rate' => intval($this->hotel->star_rate),
            'price' => $this->price,
            'hotel_id' => intval($this->hotel_id)
        ];
    }

}
