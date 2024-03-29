<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Package\ListPackageResource;
use App\Http\Resources\Package\PackageResource;
use App\Package;
use App\PackageHotel;
use App\Hotel;
use App\PackageSlider;
use App\PackageHotelPricingDetail;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = new Package();

        if (isset($request->month) && $request->month != '' && $request->month != '0' && $request->month != 'Month') {
            $query->whereMonth('publish_date', '<=', $request->month)
            ->WhereMonth('suppress_date', '>=', $request->month);
        }

        try {
            $results = $query->whereHas('packageHotels')
            ->where('country', $request->country_id)
            ->Active()->NotDraft()->Publish()
            ->orderBy('packages.package_order', 'ASC')
            ->paginate(10);
            return new ListPackageResource($results);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function view(Request $request)
    {
        $data = $request->all();
        $validatedData = Validator::make($data, [
            'package_id' => ['required', 'integer',
                Rule::exists('packages', 'id')
            ],
            'hotel_id' => ['required', 'integer',
                Rule::exists('hotels', 'id')
            ],
        ]);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                "message" => trans('exception.Validation-Error'),
                'data' => $validatedData->errors(),
                "count" => count($validatedData->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }

        try {
            $result = Package::findOrFail($data['package_id']);
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new PackageResource($result),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

    }
}
