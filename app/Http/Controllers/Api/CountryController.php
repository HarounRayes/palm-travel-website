<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Country\ListCountryResource;
use App\Package;
use Illuminate\Http\Request;

class CountryController extends Controller
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
}
