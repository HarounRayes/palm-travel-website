<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class NameResource extends JsonResource
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
        ];

        return $response;
    }
}
