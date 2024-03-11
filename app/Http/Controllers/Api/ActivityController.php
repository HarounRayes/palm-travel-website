<?php


namespace App\Http\Controllers\Api;


use App\ActivityCategory;
use App\ActivityCountry;
use App\ActivityStep;
use App\ActivityTour;
use App\ActivityType;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Activity\CountryResource;
use App\Http\Resources\Activity\ListActivityResource;
use App\Http\Resources\NameResource;
use App\Http\Resources\Activity\StepResource;
use Illuminate\Http\Request;

class ActivityController extends ApiController
{
    public function index(Request $request)
    {

        $query = new ActivityTour();
        
        if (isset($request->country_id) && $request->country_id != '')
            $query->where('activity_country_id', $request->country_id);
    
        if (isset($request->city_id))
            $query->where('activity_city_id', $request->city_id);

        if (isset($request->category) && $request->category != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('activity_category_id', $request->category);
                
                if (isset($request->service) && $request->service != '') {
                    $q->where('activity_tour_categories.type', $request->service);
                }
            });
        } elseif (isset($request->service) && $request->service != '') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('activity_tour_categories.type', $request->service);
            });
        }



        if (isset($request->duration) && $request->duration != '')
            $query->where('activity_duration', $request->duration);

        if (isset($request->for) && $request->for != '') {
            $query->whereHas('tourTypes', function ($q) use ($request) {
                $q->whereIn('activity_type_id', $request->for);
            });
        }

        if (isset($request->name) && $request->name != '')
            $query->where('name_en', 'like', '%' . $request->name . '%')
                ->orWhere('name_ar', 'like', '%' . $request->name . '%');

        if (isset($request->is_home) && $request->is_home)
            $query->Home();

        
        try {
            $results = $query->Publish()->paginate(10);
            return new ListActivityResource($results);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_steps()
    {
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => StepResource::collection(ActivityStep::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function get_categories()
    {

        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => NameResource::collection(ActivityCategory::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function get_types()
    {

        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => NameResource::collection(ActivityType::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_countries()
    {

        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => CountryResource::collection(ActivityCountry::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
