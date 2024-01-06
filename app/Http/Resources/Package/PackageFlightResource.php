<?php


namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;

class PackageFlightResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [];

        if ($this->segments) {
            foreach ($this->segments as $segmentF) {
                if ($segmentF->icon != '') {
                    $icon = url('storage/app/public/package', $segmentF->icon);
                } else {
                    $icon = '';
                }
                $response['departure_from'] = $this->departure_from;
                $response['departure_to'] = $this->departure_to;
                $response['segments']['icon'] = $icon;
                $response['segments']['flight'] = $segmentF->flight;
                $response['segments']['flight_number'] = $segmentF->flight_number;
                $response['segments']['departure_from'] = $segmentF->departure_from;
                $response['segments']['departure_date'] = $segmentF->departure_date ? date("d-m-Y", strtotime($segmentF->departure_date)) : "00-00-0000";
                $response['segments']['departure_time'] = $segmentF->departure_time;
                $response['segments']['arrival_to'] = $segmentF->departure_from;
                $response['segments']['arrival_date'] = $segmentF->arrival_date ? date("d-m-Y", strtotime($segmentF->arrival_date)) : "00-00-0000";
                $response['segments']['arrival_time'] = $segmentF->arrival_time;
            }

        }
        return $response;
    }

}
