<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Visa\NationalityResource;
use App\Http\Resources\Visa\NationalityTypeFormResource;
use App\Http\Resources\Visa\NationalityTypeResource;
use App\Http\Resources\Visa\TypeResource;
use App\VisaUaeNationality;
use App\VisaUaeNationalityType;
use App\VisaUaeType;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VisaUaeController extends Controller
{
    public function get_types()
    {
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => TypeResource::collection(VisaUaeType::Home()->get()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function get_nationalities()
    {
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => NationalityResource::collection(VisaUaeNationality::Home()->get()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get_nationality_requirments(Request $request){

        $dataIn = $request->all();
        $validatedData = Validator::make($dataIn, [
            'type_id' => ['required', 'integer',
                Rule::exists('visa_uae_types', 'id')
            ],
            'nationality_id' => ['required', 'integer',
                Rule::exists('visa_uae_nationalities', 'id')
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

        $visa_uae_nationality_types = VisaUaeNationalityType::where('visa_uae_type_id', $dataIn['type_id'])->where('visa_uae_nationality_id', $dataIn['nationality_id'])->first();

        return response()->json([
            "success" => true,
            "message" => "",
            "data" => new NationalityTypeResource($visa_uae_nationality_types),
            "total" => 1,
            "status" => 200
        ]);
    }
    public function get_visa_form(Request $request)
    {

        $dataIn = $request->all();
        $validatedData = Validator::make($dataIn, [
            'nationality_type_id' => ['required', 'integer',
                Rule::exists('visa_uae_nationality_types', 'id')
            ]
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

        $visa_nationality_type = VisaUaeNationalityType::findOrFail($request->nationality_type_id);

        return response()->json([
            "success" => true,
            "message" => "",
            "data" => new NationalityTypeFormResource($visa_nationality_type),
            "total" => 1,
            "status" => 200
        ]);
    }
}
