<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Country\ListCountryResource;
use App\Package;
use Illuminate\Http\Request;

class CountryController extends ApiController
{
    public function index(Request $request)
    {

        $packages = Package::pluck('country')->toArray();
//        $query = Country::WhereIn('id', $packages);
        $query = Country::WhereHas('packagesHome');

        try {
            $results = $query->paginate(10);
            return new ListCountryResource($results);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function view(Request $request, $id)
    {
        try {
            $result = Country::findOrFail($id);
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new CountryResource($result),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function get_countries(){
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => CountryResource::collection(Country::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_months(){
        return 'zdf';

        return config('constans.months.'.app()->getLocale());
    }
}
