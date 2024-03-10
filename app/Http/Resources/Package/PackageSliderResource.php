<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageSliderResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->image != '') {
            $image = url('storage/app/public/images/slider', $this->image);
        } else {
            $image = '';
        }
        return [
            'text' => $this->text,
            'image' => $image,
        ];
    }
}
