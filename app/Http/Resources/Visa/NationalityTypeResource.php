<?php


namespace App\Http\Resources\Visa;


use Illuminate\Http\Resources\Json\JsonResource;

class NationalityTypeResource extends JsonResource
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
            'processing_time' => $this->processing_time,
            'visa_validity' => $this->visa_validity,
            'stay_validity' => $this->stay_validity,
            'adult_price' => intval($this->adult_price),
            'child_price' => intval($this->child_price),
            'infant_price' => intval($this->infant_price),
        ];
        if (!$this->requirements->isEmpty()) {
            foreach ($this->requirements as $requirements)
                $response['requirements'][] = $requirements->requirement->name;
        }
        return $response;
    }
}
