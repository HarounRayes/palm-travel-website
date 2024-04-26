<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityCard;
use App\Blog;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StripePaymentController;
use App\Mail\VisaMember;
use App\Mail\VisaOutboundAdmin;
use App\Mail\VisaUaeAdmin;
use App\Mail\VisaUaeMember;
use App\SiteSetting;
use App\VisaCountry;
use App\VisaCountryRequirement;
use App\VisaNationality;
use App\VisaOutbound;
use App\VisaOutboundApplication;
use App\VisaOutboundApplicationPerson;
use App\VisaOutboundApplicationPersonInformation;
use App\VisaOutboundNationality;
use App\VisaType;
use App\VisaUae;
use App\VisaUaeApplication;
use App\VisaUaeApplicationPerson;
use App\VisaUaeApplicationPersonInformation;
use App\VisaUaeCountryNationality;
use App\VisaUaeCountryRequirement;
use App\VisaUaeNationality;
use App\VisaUaeNationalityType;
use App\VisaUaeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class VisaUaeController extends Controller
{
    private $filePath = "public/files/";

    public function __construct()
    {
        if (Config::get('global_models.visa') == '1') {
//            abort(404);
        }
    }

    public function index()
    {
        $types = VisaUaeType::Home()->get();
        $nationalities = VisaUaeNationality::Home()->get();
        $general_info = GeneralInformation::where('type', 'uae')->first();
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();

        return view('frontend.visa.uae.index')
            ->with([
                'types' => $types,
                'nationalities' => $nationalities,
                'info' => $general_info,
                'whatsapp' => $whatsapp
            ]);
    }


    public function search(Request $request)
    {
        $nationalities = VisaUaeNationality::all();
        $general_info = GeneralInformation::where('type', 'uae')->first();
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();

        $nationality = VisaUaeNationality::where('symbol', $request->nationality)->firstOrFail();

        if (!$nationality->is_visa) {
            return view('frontend.visa.uae.uaeNotVisa')
                ->with([
                    'nationalities' => $nationalities,
                    'info' => $general_info,
                    'nationality' => $nationality,
                    'whatsapp' => $whatsapp
                ]);
        } else {
            $type = VisaUaeType::where('symbol', $request->type)->firstOrFail();
            $visa_uae_nationality_types = VisaUaeNationalityType::where('visa_uae_type_id', $type->id)->where('visa_uae_nationality_id', $nationality->id)->first();
            $types = VisaUaeType::whereIn('id', $nationality->types_ids())->get();

            return view('frontend.visa.uae.uaeVisa')
                ->with([
                    'visa_uae_nationality_types' => $visa_uae_nationality_types,
                    'types' => $types,
                    'nationalities' => $nationalities,
                    'info' => $general_info,
                    'nationality' => $nationality,
                    'type' => $type,
                    'whatsapp' => $whatsapp
                ]);
        }
    }

    public function uaeApplication(Request $request)
    {
//        if (!Auth::guard('member')->user()) {
//            return redirect()->route('member.login');
//        }

        $visaNationalityType = VisaUaeNationalityType::findOrFail($request->nationality_type_id);

        $types = VisaUaeType::whereIn('id', $visaNationalityType->nationality->types_ids())->get();
        $nationalities = VisaUaeNationality::all();
        $general_info = GeneralInformation::where('type', 'uae')->first();
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();

        return view('frontend.visa.uae.application')
            ->with([
                'person' => intval($request->person),
                'adult' => intval($request->adult),
                'child' => intval($request->child),
                'infant' => intval($request->infant),
                'visa' => $visaNationalityType,
                'types' => $types,
                'nationalities' => $nationalities,
                'info' => $general_info,
                'whatsapp' => $whatsapp
            ]);
    }

    public function uaeApplicationSave(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptchav3:uaevisa,0.5'
        ]);

//        if (!Auth::guard('member')->user()) {
//            return redirect()->route('member.login');
//        }
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

        if (Auth::guard('member')->check())
            $dataInApplication['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

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

                Alert::success(trans('alert.success_enquiry_sent'), trans('messages.visa-uae-enquiry-message'));
            }
            return redirect()->route('visa.uae.applicant', $application->reference_id);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            Alert::warning('', trans('alert.error-add-visa'));

        }
        return redirect()->route('visa.uae');

    }

    public function addEmail(Request $request)
    {
        $counter = $request->counter;
        $application_counter = $request->application_counter;
        return response()->json(['data' => view('frontend.ajax.addEmail',
            ['application_counter' => $application_counter, 'counter' => $counter])->render()], 200);
    }

    public function applicant($reference_id)
    {
        $application = VisaUaeApplication::where('reference_id', $reference_id)->firstOrFail();
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();

        return view('frontend.visa.uae.applicant')
            ->with(['application' => $application, 'whatsapp' => $whatsapp]);
    }
}
