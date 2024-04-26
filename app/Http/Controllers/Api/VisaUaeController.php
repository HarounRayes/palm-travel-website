<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Visa\NationalityTypeFormResource;
use App\Http\Resources\Visa\NationalityTypeResource;
use App\Http\Resources\Visa\ListVisaNationalityResource;
use App\Http\Resources\Visa\TypeResource;
use App\Member;
use App\VisaUaeNationality;
use App\VisaUaeNationalityType;
use App\VisaUaeType;
use App\VisaUaeApplication;
use App\VisaUaeApplicationPerson;
use App\VisaUaeApplicationPersonInformation;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisaUaeController extends ApiController
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

    public function get_countries()
    {
        try {
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => new ListVisaNationalityResource(VisaUaeNationality::all()),
                "total" => 1,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function get_nationalities()
    {
        // $query = ;
        try {

            return new ListVisaNationalityResource(VisaUaeNationality::paginate(10));

            // return response()->json([
            //     "success" => true,
            //     "message" => "",
            //     "data" => new ListVisaNationalityResource($query),
            //     "total" => 1,
            //     "status" => 200
            // ]);
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
        
        $visa_uae_nationality_types = VisaUaeNationalityType::where('visa_uae_type_id', $request->type_id)
            ->where('visa_uae_nationality_id', $request->nationality_id)
            ->first();
        
        return response()->json([
            "success" => true,
            "message" => "",
            "data" => new NationalityTypeResource($visa_uae_nationality_types),
            "csrf_token" => csrf_token(),
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

    
    public function uaeApplicationSave(Request $request)
    {
        $visa = VisaUaeNationalityType::findOrFail($request->visa_uae_nationality_type_id);

        $price = intval($request->adult) * intval($visa->adult_price);
        $price += intval($request->child) * intval($visa->child_price);
        $price += intval($request->infant) * intval($visa->infant_price);

        $dataInApplication['visa_uae_nationality_type_id'] = $request->visa_uae_nationality_type_id;
        $dataInApplication['visa_uae_type_id'] = $visa->type->id;
        $dataInApplication['visa_uae_nationality_id'] = $visa->nationality->id;

        $dataInApplication['person_number'] = $request->person_number;
        $dataInApplication['adult'] = $request->adult;
        $dataInApplication['child'] = $request->child;
        $dataInApplication['infant'] = $request->infant;

        $dataInApplication['price'] = $price;

        $dataInApplication['reference_id'] = 'visa' . Carbon::now()->timestamp;

        if ($request->user_id !== '0'){
            $dataInApplication['member_id'] = Member::find($request->user_id)->getAuthIdentifier();
        }

        if (isset($request->submit_checkout))
            $dataInApplication['is_proceed'] = true;

        if (isset($request->enquiry)) {
            $dataInApplication['is_enquiry'] = true;
            $dataInApplication['active'] = 1;
        }

        try {
            DB::beginTransaction();
            $application = VisaUaeApplication::create($dataInApplication);
            $j = 0;

            $pp = count($request->only('requirement'));
            if ($pp <= 0) return response()->json(["message" => "Error Occured"], 422);
            for ($i = 1; $i < ($request->person_number + 1); $i++) {
                $dataInPerson['visa_uae_application_id'] = $application->id;
                $person = VisaUaeApplicationPerson::create($dataInPerson);

                $req_fields = $request->only('requirement')['requirement'];
                $email_fields = $request->only('email');
                $code_fields = $request->only('code');
                $mobile_fields = $request->only('mobile');

                $dataPersonInfoArray['visa_uae_application_person_id'] = $person->id;
                foreach ($visa->requirements_documents as $requirement) {
                    $dataPersonInfoArray['visa_uae_requirement_id'] = $requirement->requirement->id;

                    if (isset($request->file[$requirement->requirement->field][$i])) {
                        $fileName = time() . $person->id . $requirement->requirement->name_en . '.' . $request->file[$requirement->requirement->field][$i]->getClientOriginalExtension();
                        $request->file[$requirement->requirement->field][$i]->storeAs($this->filePath, $fileName);
                        $dataPersonInfoArray['value'] = $fileName;

                        VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
                    }
                }

                foreach ($visa->requirements_contacts() as $requirement) {
                    $dataPersonInfoArray['visa_uae_requirement_id'] = $requirement->id;

                    if ($requirement->type == 'email_address') {
                        for ($t = 0; $t < $req_fields[$i]['email_counter']; $t++) {
                            if (isset($email_fields['email'][$i][$t])) {
                                $dataPersonInfoArray['value'] = $email_fields['email'][$i][$t];
                                VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);

                                if ($j == 0) {
                                    $emails_arr[] = $email_fields['email'][$i][$t];
                                }
                                $j++;
                            }
                        }
                    }
//                    elseif ($requirement->type == 'code') {
//                        for ($t = 0; $t < $req_fields[$i]['email_counter']; $t++) {
//                            if (isset($code_fields['country_code'][$i][$t])) {
//                                $dataPersonInfoArray['value'] = $code_fields['country_code'][$i][$t];
//                                VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
//                            }
//                        }
//                    } elseif ($requirement->type == 'mobile_number') {
//                        for ($t = 0; $t < $req_fields[$i]['email_counter']; $t++) {
//                            if (isset($mobile_fields['mobile_number'][$i][$t])) {
//                                $dataPersonInfoArray['value'] = $mobile_fields['mobile_number'][$i][$t];
//                                VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
//                            }
//                        }
//                    }
                    else {
                        if (isset($req_fields[$i][$requirement->field])) {
                            $dataPersonInfoArray['value'] = $req_fields[$i][$requirement->field];
                            VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
                        }
                    }
                    $dataPersonInfoArray['value'] = '';
                }

                foreach ($visa->requirements_main() as $requirement) {
                    $dataPersonInfoArray['visa_uae_requirement_id'] = $requirement->id;

                    if (isset($req_fields[$i][$requirement->field])) {
                        $dataPersonInfoArray['value'] = $req_fields[$i][$requirement->field];
                        VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
                    }

                }

            }
            DB::commit();
            if (isset($request->submit_checkout)) {
                $items[] = [
                    'price_data' => [
                        'currency' => 'AED',
                        'product_data' => [
                            'name' => $visa->nationality->name.'-'.$visa->type->name
                        ],
                        'unit_amount' => (intval($application['price']) * 100),
                    ],
                    'quantity' => 1,
                ];

                $StripePaymentController = new StripePaymentController();

                return $StripePaymentController->create_visa_uae_checkout_session($items,$application->id);

            } else {
//                Mail::to($application->people[0]->emails()[0]->value)->send(new VisaUaeMember($application));
//                Mail::to(config("app.to.address"))->send(new VisaUaeAdmin($application));

                // Alert::success(trans('alert.success_enquiry_sent'), trans('messages.visa-uae-enquiry-message'));
                return response()->json([
                    "success" => true,
                    "message" => trans('messages.visa-uae-enquiry-message'),
                    "data" => $application,
                    "total" => 1,
                    "status" => 200
                ]);
            }

            
            
            // return redirect()->route('visa.uae.applicant', $application->reference_id);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return response()->json(trans('alert.error-add-visa'), 200, $headers);
            // Alert::warning('', trans('alert.error-add-visa'));
        }

        return response()->json('', 200);
        // return redirect()->route('visa.uae');
    }

}
