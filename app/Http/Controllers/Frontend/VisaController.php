<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityCard;
use App\Blog;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;


class VisaController extends Controller
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
        $visa_countries = VisaCountry::ToHome()->get();
        $types = VisaType::ToHome()->get();

        $uae_checked = '';
        $outbound_checked = 'checked';
        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();
        return view('frontend.visa.index')
            ->with([
                'visa_countries' => $visa_countries,
                'types' => $types,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);
    }

    public function uae(Request $request)
    {
        $visas = VisaUae::all();

        $uae_checked = 'checked';
        $outbound_checked = '';

        if (isset($request->nationality) && $request->nationality) {
            $visas = VisaUae::whereHas('nationalities', function ($query) use ($request) {
                $query->where('visa_uae_nationalities.visa_nationality_id', $request->nationality);
            })->get();
            $nationality = VisaNationality::findOrFail($request->nationality);

            return view('frontend.visa.uaeNationality')
                ->with([
                    'visas' => $visas,
                    'nationality' => $nationality,
                    'uae_checked' => $uae_checked,
                    'outbound_checked' => $outbound_checked
                ]);
        }
        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();
        return view('frontend.visa.uae')
            ->with([
                'visas' => $visas,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);

    }

    public function setUaeNationality(Request $request)
    {
        $nationalities = VisaNationality::all();
        $visa = VisaUae::findOrFail($request->visa_id);
        return response()->json(['data' => view('frontend.ajax.setUaeNationality',
            ['nationalities' => $nationalities, 'visa' => $visa])->render()], 200);
    }

    public function setNationality(Request $request)
    {
        $nationalities = VisaNationality::all();
        $visa = VisaOutbound::findOrFail($request->visa_id);
        return response()->json(['data' => view('frontend.ajax.setNationality',
            ['nationalities' => $nationalities, 'visa' => $visa])->render()], 200);
    }

    public function uaeSearch(Request $request)
    {
        $uae_checked = 'checked';
        $outbound_checked = '';
        $enable_nationality = true;

        $visa = VisaUae::findOrFail($request->visa);
        $nationality = VisaNationality::findOrFail($request->nationality);

        $visaNationality = VisaUaeNationality::where('visa_uae_id', $request->visa)->where('visa_nationality_id', $request->nationality)->first();
        if (!$visaNationality)
            $enable_nationality = false;

        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();
        return view('frontend.visa.uaeNationalityVisa')
            ->with([
                'visa' => $visa,
                'nationality' => $nationality,
                'visaNationality' => $visaNationality,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'enable_nationality' => $enable_nationality,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);
    }


    public function visaTypeOutbound()
    {
        return response()->json(['data' => view('frontend.visa.visaTypeOutbound')->render()], 200);
    }

    public function visaTypeUae()
    {
        return response()->json(['data' => view('frontend.visa.visaTypeUae')->render()], 200);
    }

    public function outbound(Request $request)
    {
        $uae_checked = '';
        $outbound_checked = 'checked';
        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        if (isset($request->country) && isset($request->nationality)) {
            $country = VisaCountry::findOrFail($request->country);
            $visas = VisaOutbound::where('visa_country_id', $request->country)->whereHas('nationalities', function ($query) use ($request) {
                $query->where('visa_outbound_nationalities.visa_nationality_id', $request->nationality);
            })->get();

            return view('frontend.visa.outbound')
                ->with([
                    'visas' => $visas,
                    'country' => $country,
                    'uae_checked' => $uae_checked,
                    'outbound_checked' => $outbound_checked,
                    'countries' => $countries,
                    'nationalities' => $nationalities,
                    'info' => $general_info
                ]);
        } else {
            $visas = VisaOutbound::all();
            return view('frontend.visa.list')
                ->with([
                    'visas' => $visas,
                    'uae_checked' => $uae_checked,
                    'outbound_checked' => $outbound_checked,
                    'countries' => $countries,
                    'nationalities' => $nationalities,
                    'info' => $general_info
                ]);
        }

    }

    public function type(Request $request, $type)
    {
        $uae_checked = '';
        $outbound_checked = 'checked';

        $visaOutboundModel = new VisaOutbound();
        $visaUaeModel = new VisaUae();

        if (isset($type) && $type != '') {
            $visaOutboundModel->whereHas('type', function ($query) use ($type) {
                $query->where('visa_types.symbol', $type);
            });

            $visaUaeModel->whereHas('type', function ($query) use ($type) {
                $query->where('visa_types.symbol', $type);
            });
        }
        $visaOutbound = $visaOutboundModel->get();
        $visaUae = $visaUaeModel->get();
        $visas = $visaOutbound->merge($visaUae);
        $type = VisaType::where('symbol', $type)->firstOrFail();

        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        return view('frontend.visa.type')
            ->with([
                'visas' => $visas,
                'type' => $type,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);

    }

    public function country(Request $request, $country)
    {
        $uae_checked = '';
        $outbound_checked = 'checked';

        $visaOutbound = VisaOutbound::whereHas('country', function ($query) use ($country) {
            $query->where('visa_countries.symbol', $country);
        })->get();
        $country = VisaCountry::where('symbol', $country)->firstOrFail();

        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        return view('frontend.visa.country')
            ->with([
                'visas' => $visaOutbound,
                'country' => $country,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);

    }

    public function outboundSearch(Request $request)
    {
        $uae_checked = '';
        $outbound_checked = 'checked';

        $enable_nationality = true;

        $visa = VisaOutbound::findOrFail($request->visa);
        $nationality = VisaNationality::findOrFail($request->nationality);

        $visaNationality = VisaOutboundNationality::where('visa_outbound_id', $request->visa)->where('visa_nationality_id', $request->nationality)->first();

        if (!$visaNationality)
            $enable_nationality = false;

        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        return view('frontend.visa.outboundNationalityVisa')
            ->with([
                'visa' => $visa,
                'nationality' => $nationality,
                'visaNationality' => $visaNationality,
                'uae_checked' => $uae_checked,
                'outbound_checked' => $outbound_checked,
                'enable_nationality' => $enable_nationality,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);
    }

    public function uaeApplication(Request $request)
    {
        if (!Auth::guard('member')->user()) {
            return redirect()->route('member.login');
        }

        $visa = VisaUae::findOrFail($request->visa_id);
        $visaNationality = VisaUaeNationality::findOrFail($request->visa_country_nationality_id);
        $person = $request->person;

        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        return view('frontend.visa.uaeApplication')
            ->with([
                'visa' => $visa,
                'person' => $person,
                'visaNationality' => $visaNationality,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);
    }

    public function outboundApplication(Request $request)
    {
        if (!Auth::guard('member')->user()) {
            return redirect()->route('member.login');
        }
        $visa = VisaOutbound::findOrFail($request->visa_id);
        $visaNationality = VisaOutboundNationality::findOrFail($request->visa_country_nationality_id);
        $person = $request->person;
        $countries = VisaCountry::all();
        $nationalities = VisaNationality::all();
        $general_info = GeneralInformation::where('type', 'visa')->first();

        return view('frontend.visa.outboundApplication')
            ->with([
                'visa' => $visa,
                'person' => $person,
                'visaNationality' => $visaNationality,
                'countries' => $countries,
                'nationalities' => $nationalities,
                'info' => $general_info
            ]);
    }

    public function uaeApplicationSave(Request $request)
    {
        if (!Auth::guard('member')->user()) {
            return redirect()->route('member.login');
        }
        $visa = VisaUae::findOrFail($request->visa_id);
        $requirements = VisaUaeCountryRequirement::all();
        $visa_uae_nationality_id = VisaUaeNationality::findOrFail($request->visa_uae_nationality_id);


        $dataInApplication['visa_uae_id'] = $request->visa_id;
        $dataInApplication['visa_nationality_id'] = $visa_uae_nationality_id->nationality->id;
        $dataInApplication['person_number'] = $request->person_number;
        $dataInApplication['price'] = $visa_uae_nationality_id->price;
        $dataInApplication['note'] = $request->note;
        $dataInApplication['reference_id'] = hexdec(uniqid());
        if (Auth::guard('member')->user())
            $dataInApplication['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
        if (isset($request->submit))
            $dataInApplication['is_proceed'] = true;

        if (isset($request->enquiry))
            $dataInApplication['is_enquiry'] = true;

        $application = VisaUaeApplication::create($dataInApplication);
        $j = 0;
        for ($i = 1; $i < ($request->person_number + 1); $i++) {
            $dataInPerson['visa_uae_application_id'] = $application->id;
            $person = VisaUaeApplicationPerson::create($dataInPerson);
            $req_fields = $request->only('requirement')['requirement'];
            $email_fields = $request->only('email');

            foreach ($requirements as $requirement) {
                $dataPersonInfoArray['visa_requirement_id'] = $requirement->requirement->id;
                $dataPersonInfoArray['visa_uae_application_person_id'] = $person->id;
                if ($requirement->requirement->type == 'email_address') {
                    for ($t = 0; $t < $req_fields[$i]['email_counter']; $t++) {
                        if (isset($email_fields['email'][$i][$t])) {
                            $dataPersonInfoArray['value'] = $email_fields['email'][$i][$t];//$_POST['email_' . $i . '_' . $t];
                            VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);

                            if ($j == 0) {
                                $emails_arr[] = $email_fields['email'][$i][$t];
                            }
                            $j++;
                        }
                    }
                } elseif ($requirement->requirement->type == 'file') {
                    if (isset($request->file[$requirement->requirement->field][$i])) {
                        $fileName = time() . $requirement->requirement->name_en . '.' . $request->file[$requirement->requirement->field][$i]->getClientOriginalExtension();
                        $request->file[$requirement->requirement->field][$i]->storeAs($this->filePath, $fileName);
                        $dataPersonInfoArray['value'] = $fileName;

                        VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
                    }
                } else {
                    if (isset($req_fields[$i][$requirement->requirement->field])) {
                        $dataPersonInfoArray['value'] = $req_fields[$i][$requirement->requirement->field];
                        VisaUaeApplicationPersonInformation::create($dataPersonInfoArray);
                    }
                }
            }
        }
        if (isset($request->enquiry)) {
            Mail::to($application->member->email)
                ->send(new VisaUaeMember($application));

            Mail::to(env('MAIL_FROM_ADDRESS'))
                ->send(new VisaUaeAdmin($application));
            if (Mail::failures()) {
                Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
            } else {
                Alert::success(trans('alert.success_enquiry_sent'), trans('messages.visa-uae-enquiry-message'));
            }
        } else {
            return view('frontend.visa.uaeApplicant')
                ->with(['application' => $application, 'visa' => $visa]);
        }
        return redirect()->route('visa.uae');

    }

    public function outboundApplicationSave(Request $request)
    {
        if (!Auth::guard('member')->user()) {
            return redirect()->route('member.login');
        }
        $visa = VisaOutbound::findOrFail($request->visa_id);
        $requirements = VisaCountryRequirement::where('visa_country_id', $visa->visa_country_id)->get();
        $visa_outbound_nationality_id = VisaOutboundNationality::findOrFail($request->visa_outbound_nationality_id);


        $dataInApplication['visa_outbound_id'] = $request->visa_id;
        $dataInApplication['visa_country_id'] = $visa->visa_country_id;
        $dataInApplication['visa_nationality_id'] = $visa_outbound_nationality_id->nationality->id;
        $dataInApplication['person_number'] = $request->person_number;
        $dataInApplication['price'] = $visa_outbound_nationality_id->price;
        $dataInApplication['note'] = $request->note;
        $dataInApplication['reference_id'] = hexdec(uniqid());
        if (Auth::guard('member')->user())
            $dataInApplication['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
        if (isset($request->submit))
            $dataInApplication['is_proceed'] = true;

        if (isset($request->enquiry))
            $dataInApplication['is_enquiry'] = true;

        $application = VisaOutboundApplication::create($dataInApplication);
        $j = 0;
        for ($i = 1; $i < ($request->person_number + 1); $i++) {
            $dataInPerson['visa_outbound_application_id'] = $application->id;
            $person = VisaOutboundApplicationPerson::create($dataInPerson);
            $req_fields = $request->only('requirement');
            $email_fields = $request->only('email');
            if (isset($req_fields)) {
                $req_fields = $req_fields['requirement'];
                foreach ($requirements as $requirement) {
                    $dataPersonInfoArray['visa_requirement_id'] = $requirement->requirement->id;
                    $dataPersonInfoArray['visa_outbound_application_person_id'] = $person->id;
                    if ($requirement->requirement->type == 'email_address') {
                        for ($t = 0; $t < $req_fields[$i]['email_counter']; $t++) {
                            if (isset($email_fields['email'][$i][$t])) {

                                $dataPersonInfoArray['value'] = $email_fields['email'][$i][$t];//$_POST['email_' . $i . '_' . $t];
                                VisaOutboundApplicationPersonInformation::create($dataPersonInfoArray);

                                if ($j == 0) {
                                    $emails_arr[] = $email_fields['email'][$i][$t];
                                }
                                $j++;
                            }
                        }
                    } elseif ($requirement->requirement->type == 'file') {
                        if (isset($request->file[$requirement->requirement->field][$i])) {
                            $fileName = time() . $requirement->requirement->name_en . '.' . $request->file[$requirement->requirement->field][$i]->getClientOriginalExtension();
                            $request->file[$requirement->requirement->field][$i]->storeAs($this->filePath, $fileName);
                            $dataPersonInfoArray['value'] = $fileName;

                            VisaOutboundApplicationPerson::create($dataPersonInfoArray);
                        }
                    } else {
                        if (isset($req_fields[$i][$requirement->requirement->field])) {
                            $dataPersonInfoArray['value'] = $req_fields[$i][$requirement->requirement->field];
                            VisaOutboundApplicationPersonInformation::create($dataPersonInfoArray);
                        }
                    }
                }
            }
        }
        if (isset($request->enquiry)) {
            Mail::to($application->member->email)
                ->send(new VisaMember($application));

            Mail::to(env('MAIL_FROM_ADDRESS'))
                ->send(new VisaOutboundAdmin($application));
            if (Mail::failures()) {
                Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
            } else {
                Alert::success(trans('alert.success_enquiry_sent'), trans('messages.success-add-outbound-visa'));
            }

        } else {
            return view('frontend.visa.outboundApplicant')
                ->with(['application' => $application, 'visa' => $visa]);
        }
        return redirect()->route('visa.outbound');
    }

    public function addEmail(Request $request)
    {
        $counter = $request->counter;
        $application_counter = $request->application_counter;
        return response()->json(['data' => view('frontend.ajax.addEmail',
            ['application_counter' => $application_counter, 'counter' => $counter])->render()], 200);
    }
}
