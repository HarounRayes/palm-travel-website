<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageLabelResource extends JsonResource
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
            'value' => $this->value,
            'color' => $this->color,
        ];
    }
}
