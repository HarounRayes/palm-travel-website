<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageDayResource extends JsonResource
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
            'day_title' => $this->day_title,
            'open_day' => $this->open_day ? 1 : 0,
            'day_description' => $this->day_description,
            'tours' => PackageDayTourResource::collection($this->PackageDayTour)
        ];
    }

}
