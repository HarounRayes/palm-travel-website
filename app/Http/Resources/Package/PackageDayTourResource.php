<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageDayTourResource extends JsonResource
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
            'tour_name' => $this->tour->name,
            'tour_description' => $this->tour->text,
            'tour_image' => $this->tour->image,
            'is_car' => $this->tour->is_car,
            'is_bus' => $this->tour->is_bus,
            'price_bus' => $this->tour->price_bus,
            'price_car' => [
                'price_1' => $this->tour->price_1,
                'price_2' => $this->tour->price_2,
                'price_3' => $this->tour->price_3,
                'child_0_2' => $this->tour->child_0_2,
                'child_2_12' => $this->tour->child_2_12,
                'child_12' => $this->tour->child_12,
                ],
        ];
    }

}
