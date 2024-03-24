<?php

namespace App\Http\Resources\Package;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Resources\Package\PackageHotelsResource;

use App\Hotel;
use App\PackageSlider;
use App\PackageHotel;
use App\PackageHotelPricingDetail;

class PackageResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->package_image_header != '') {
            $header_image = url('storage/app/public/images/package', $this->package_image_header);
        } else {
            $header_image = '';
        }

        if ($this->pdf != '') {
            $pdf = url('storage/app/public/pdf', $this->pdf);
        } else {
            $pdf = '';
        }

        if ($this->map != '') {
            $map = url('storage/app/public/images/package', $this->map);
        } else {
            $map = '';
        }

        $hotelPricings = PackageHotelPricingDetail::where('package_hotel_id', (
            PackageHotel::where('package_id', $this->id)->where('hotel_id', $this->defaultHotel()->id)->firstOrFail()->id
        ))->get();

        $response = [
            'id' => $this->id,
            'symbol' => $this->symbol,
            'name' => $this->name,
            'pdf' => $pdf,
            'package_image_header' => $header_image,
            'map' => $map,
            'video' => $this->video,
            'overview' => $this->overview,
            'open_include' => $this->open_include ? 1 : 0,
            'open_not_include' => $this->open_not_include ? 1 : 0,
            'open_term' => $this->open_term ? 1 : 0,
            'terms_condition' => $this->terms_condition,
            'open_cancellation' => $this->open_cancellation ? 1 : 0,
            'cancellation_policy' => $this->cancellation_policy,
            'open_additional_info' => $this->open_additional_info ? 1 : 0,
            'additional_info' => $this->additional_info,

            'sliders' => PackageSliderResource::collection($this->sliders),
            'inclusions' => PackageInExclusionsResource::collection($this->inclusions),
            'exclusions' => PackageInExclusionsResource::collection($this->exclusions),
            'days' => PackageDayResource::collection($this->days),
            'flights' => PackageFlightResource::collection($this->flights),
            'transfers' => PackageTransferResource::collection($this->transfers),
            'hotels' => new PackageHotelsResource(Hotel::where('symbol', $this->defaultHotel()->symbol)->get()),
            'hotels_pricing' => ListPackageHotelPricingResource::collection($hotelPricings),
        ];

        return $response;
    }
}
