<?php


namespace App\Http\Controllers\Api;


use App\Country;
use App\Enquiry;
use App\GeneralInformation;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\Country\ListCountryResource;
use App\Http\Resources\Country\HomeCountryResource;
use App\Http\Resources\HomePage\PartnerResources;
use App\Http\Resources\HomePage\ServiceResources;
use App\Newsletter;
use App\Package;
use App\Partner;
use App\Service;
use App\Slider;
use App\Http\Resources\HomePage\SliderResources;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends ApiController
{

    public function getHomeData(){
        $sliders = Slider::orderBy('id', 'DESC')->get();
        $partners = Partner::all();
        $services = Service::all();
        $countries = Country::WhereHas('packagesHome')->where('add_to_home', 1)->orderBy('country_order', 'ASC')->get();

        try {

            return  $this->respondWithSuccess(
                [
                    'silders' => SliderResources::collection($sliders),
                    'partners' => PartnerResources::collection($partners),
                    'services' => ServiceResources::collection($services),
                    'countries' => new ListCountryResource($countries),
                ],
                "Data is returned successfully", 
                200
            );
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function get_sliders(){
        $sliders = Slider::orderBy('id', 'DESC')->get();
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => SliderResources::collection($sliders),
                "total" => $sliders->count(),
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_partners(){
        $sliders = Partner::all();
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => PartnerResources::collection($sliders),
                "total" => $sliders->count(),
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_services(){
        $sliders = Service::all();
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => ServiceResources::collection($sliders),
                "total" => $sliders->count(),
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function set_newsletter(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                "message" => 'Validation Error',
                'data' => $validator->errors(),
                "count" => count($validator->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }

        $old = Newsletter::where('email', $data['email'])->first();

        if (!$old)
            Newsletter::create($data);

        return response()->json([
            "success" => true,
            "message" => "Newsletter has added successfully",
            "data" => [],
            "total" => 0,
            "status" => 200
        ]);

    }

    public function get_home_countries(){
//        $packages = Package::pluck('country')->toArray();
        $countries = Country::WhereHas('packagesHome')->where('add_to_home', 1)->orderBy('country_order', 'ASC')->get();
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => HomeCountryResource::collection($countries),
                "total" => $countries->count(),
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_home_video()
    {
        $service_image = GeneralInformation::where('type', 'service-image')->firstOrFail();

        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => [
                    'intro' => $service_image->intro,
                    'is_image' => $service_image->is_image ? 1 : 0,
                    'image' => url('storage/app/public/images/info/' . $service_image->header_image),
                    'video_link' => $service_image->header_image
                ],
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function set_enquiry(Request $request)
    {
        $dataIn = $request->all();
        $validator = Validator::make($dataIn, [
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                "message" => 'Validation Error',
                'data' => $validator->errors(),
                "count" => count($validator->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }

        $dataIn['custom'] = '1';
        $dataIn['complete'] = 1;
        if (Auth::guard('api')->check()) {
            $dataIn['member_id'] = Auth::guard('api')->id();
        }

        $enquiry = Enquiry::create($dataIn);

        if ($enquiry)
            return response()->json([
                "success" => true,
                "message" => "Enquiry has added successfully",
                "data" => [],
                "total" => 0,
                "status" => 200
            ]);
        else
            return response()->json([
                "success" => false,
                "message" => "error",
                "data" => [],
                "total" => 0,
                "status" => 200
            ]);

    }
}
