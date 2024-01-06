<?php

namespace App\Http\Controllers\Backend;

use App\GeneralInformation;
use App\Http\Controllers\Controller;
use App\VisaNationality;
use App\VisaRequirement;
use App\VisaUae;
use App\VisaUaeCountryNationality;
use App\VisaUaeCountryRequirement;
use App\VisaUaeExclusion;
use App\VisaUaeInclusion;
use App\VisaUaeNationality;
use App\VisaType;
use App\VisaUaeNationalityType;
use App\VisaUaeNationalityTypeRequirement;
use App\VisaUaeRequirement;
use App\VisaUaeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class VisaUaeNationalityController extends Controller
{
    private $imagePath = "public/images/visa/";
    private $imagePathInfo = "public/images/info/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.uae.nationality.create.en|visa.uae.nationality.create.ar')->only(['create', 'store']);
        $this->middleware('permission:visa.uae.nationality.edit.en|visa.uae.nationality.edit.ar')->only(['edit', 'update']);
        $this->middleware('permission:visa.uae.nationality.delete')->only('destroy');
    }

    public function index()
    {
        $nationalities = VisaUaeNationality::orderBy('id', 'DESC')->get();
        return view('backend.visa.uae.nationality.index')->with(['nationalities' => $nationalities]);
    }

    public function create()
    {
        $types = VisaUaeType::orderBy('id', 'DESC')->get();
        return view('backend.visa.uae.nationality.create')->with(['types' => $types]);
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();

        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        try {
            DB::beginTransaction();
            $uae = VisaUaeNationality::create($dataIn);

            if ($dataIn['is_visa']) {
                if (isset($request->type)) {
                    $all_types = $request->type;
                    $dataType['visa_uae_nationality_id'] = $uae->id;
                    foreach ($all_types['type_id'] as $i => $type_id) {
                        $dataType['visa_uae_type_id'] = $type_id;
                        $dataType['adult_price'] = $all_types['adult_price'][$i] ? $all_types['adult_price'][$i] : 0;
                        $dataType['child_price'] = $all_types['child_price'][$i] ? $all_types['child_price'][$i] : 0;
                        $dataType['infant_price'] = $all_types['infant_price'][$i] ? $all_types['infant_price'][$i] : 0;

                        $dataType['processing_time_en'] = $all_types['processing_time_en'][$i] ? $all_types['processing_time_en'][$i] : '';
                        $dataType['processing_time_ar'] = $all_types['processing_time_ar'][$i] ? $all_types['processing_time_ar'][$i] : '';
                        $dataType['visa_validity_en'] = $all_types['visa_validity_en'][$i] ? $all_types['visa_validity_en'][$i] : '';
                        $dataType['visa_validity_ar'] = $all_types['visa_validity_ar'][$i] ? $all_types['visa_validity_ar'][$i] : '';
                        $dataType['stay_validity_en'] = $all_types['stay_validity_en'][$i] ? $all_types['stay_validity_en'][$i] : '';
                        $dataType['stay_validity_ar'] = $all_types['stay_validity_ar'][$i] ? $all_types['stay_validity_ar'][$i] : '';
                        $dataType['term_and_condition_en'] = $all_types['term_and_condition_en'][$i] ? $all_types['term_and_condition_en'][$i] : '';
                        $dataType['term_and_condition_ar'] = $all_types['term_and_condition_ar'][$i] ? $all_types['term_and_condition_ar'][$i] : '';

                        if (isset($all_types['is_default'][$i]))
                            $dataType['is_default'] = 1;
                        else
                            $dataType['is_default'] = 0;

                        if (isset($all_types['checkout'][$i]))
                            $dataType['checkout'] = 1;
                        else
                            $dataType['checkout'] = 0;

                        $visa_nationality_type = VisaUaeNationalityType::create($dataType);

                        $dataReq['visa_uae_type_id'] = $type_id;
                        $dataReq['visa_uae_nationality_id'] = $uae->id;
                        $dataReq['visa_uae_nationality_type_id'] = $visa_nationality_type->id;

                        if (isset($all_types['requirements'][$i])) {
                            $requirements = $all_types['requirements'][$i];
                            foreach ($requirements as $requirement) {
                                $dataReq['visa_uae_requirement_id'] = $requirement;
                                VisaUaeNationalityTypeRequirement::create($dataReq);
                            }
                        }
                    }
                }
            }

            $dataUp =[];
            if ($request->has('image_en') != null) {
                $imageName = time() . '.uaevisaimageen' . $uae->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataUp['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                $imageName = time() . '.uaevisaimagear' . $uae->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataUp['image_ar'] = $imageName;
            }

            if ($request->has('header_image_en') != null) {
                $imageName = time() . '.uaevisaheaderimageen' . $uae->id . '.' . $request->header_image_en->getClientOriginalExtension();
                $request->header_image_en->storeAs($this->imagePath, $imageName);
                $dataUp['header_image_en'] = $imageName;
            }

            if ($request->has('header_image_ar') != null) {
                $imageName = time() . '.uaevisaheaderimagear' . $uae->id . '.' . $request->header_image_ar->getClientOriginalExtension();
                $request->header_image_ar->storeAs($this->imagePath, $imageName);
                $dataUp['header_image_ar'] = $imageName;
            }
            $uae->update($dataUp);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('admin.uaeNationalities.index');
    }

    public function edit($id)
    {
        $uae = VisaUaeNationality::findOrFail($id);
        $types = VisaUaeType::orderBy('id', 'DESC')->get();
        $requirements = VisaUaeRequirement::document()->get();
        return view('backend.visa.uae.nationality.edit', compact('uae', 'types', 'requirements'));
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $uae = VisaUaeNationality::findOrFail($id);
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        try {
            DB::beginTransaction();
            if ($request->has('image_en') != null) {
                if (File::exists(storage_path($this->imagePath . $uae->image_en))) {
                    File::delete(storage_path($this->imagePath . $uae->image_en));
                }

                $imageName = time() . '.uaevisaimageen' . $uae->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataIn['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                if (File::exists(storage_path($this->imagePath . $uae->image_ar))) {
                    File::delete(storage_path($this->imagePath . $uae->image_ar));
                }

                $imageName = time() . '.uaevisaimagear' . $uae->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataIn['image_ar'] = $imageName;
            }

            if ($request->has('header_image_en') != null) {
                if (File::exists(storage_path($this->imagePath . $uae->header_image_en))) {
                    File::delete(storage_path($this->imagePath . $uae->header_image_en));
                }

                $imageName = time() . '.uaevisaheaderimageen' . $uae->id . '.' . $request->header_image_en->getClientOriginalExtension();
                $request->header_image_en->storeAs($this->imagePath, $imageName);
                $dataIn['header_image_en'] = $imageName;
            }

            if ($request->has('header_image_ar') != null) {
                if (File::exists(storage_path($this->imagePath . $uae->header_image_ar))) {
                    File::delete(storage_path($this->imagePath . $uae->header_image_ar));
                }
                $imageName = time() . '.uaevisaheaderimagear' . $uae->id . '.' . $request->header_image_ar->getClientOriginalExtension();
                $request->header_image_ar->storeAs($this->imagePath, $imageName);
                $dataIn['header_image_ar'] = $imageName;
            }
            $uae->update($dataIn);

            if ($uae->is_visa) {
                if (isset($request->type)) {
                    VisaUaeNationalityType::where('visa_uae_nationality_id', $id)->delete();
                    VisaUaeNationalityTypeRequirement::where('visa_uae_nationality_id', $id)->delete();
                    $all_types = $request->type;
                    $dataType['visa_uae_nationality_id'] = $id;
                    foreach ($all_types['type_id'] as $i => $type_id) {
                        $dataType['visa_uae_type_id'] = $type_id;
                        $dataType['adult_price'] = $all_types['adult_price'][$i] ? $all_types['adult_price'][$i] : 0;
                        $dataType['child_price'] = $all_types['child_price'][$i] ? $all_types['child_price'][$i] : 0;
                        $dataType['infant_price'] = $all_types['infant_price'][$i] ? $all_types['infant_price'][$i] : 0;

                        $dataType['processing_time_en'] = $all_types['processing_time_en'][$i] ? $all_types['processing_time_en'][$i] : '';
                        $dataType['processing_time_ar'] = $all_types['processing_time_ar'][$i] ? $all_types['processing_time_ar'][$i] : '';
                        $dataType['visa_validity_en'] = $all_types['visa_validity_en'][$i] ? $all_types['visa_validity_en'][$i] : '';
                        $dataType['visa_validity_ar'] = $all_types['visa_validity_ar'][$i] ? $all_types['visa_validity_ar'][$i] : '';
                        $dataType['stay_validity_en'] = $all_types['stay_validity_en'][$i] ? $all_types['stay_validity_en'][$i] : '';
                        $dataType['stay_validity_ar'] = $all_types['stay_validity_ar'][$i] ? $all_types['stay_validity_ar'][$i] : '';
                        $dataType['term_and_condition_en'] = $all_types['term_and_condition_en'][$i] ? $all_types['term_and_condition_en'][$i] : '';
                        $dataType['term_and_condition_ar'] = $all_types['term_and_condition_ar'][$i] ? $all_types['term_and_condition_ar'][$i] : '';

                        if (isset($all_types['is_default'][$i]))
                            $dataType['is_default'] = 1;
                        else
                            $dataType['is_default'] = 0;

                        if (isset($all_types['checkout'][$i]))
                            $dataType['checkout'] = 1;
                        else
                            $dataType['checkout'] = 0;

                        $visa_nationality_type = VisaUaeNationalityType::create($dataType);

                        $dataReq['visa_uae_type_id'] = $type_id;
                        $dataReq['visa_uae_nationality_id'] = $uae->id;
                        $dataReq['visa_uae_nationality_type_id'] = $visa_nationality_type->id;

                        if (isset($all_types['requirements'][$i])) {
                            $requirements = $all_types['requirements'][$i];
                            foreach ($requirements as $requirement) {
                                $dataReq['visa_uae_requirement_id'] = $requirement;
                                VisaUaeNationalityTypeRequirement::create($dataReq);
                            }
                        }
                    }
                }
            } else {
                VisaUaeNationalityType::where('visa_uae_nationality_id', $id)->delete();
                VisaUaeNationalityTypeRequirement::where('visa_uae_nationality_id', $id)->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('admin.uaeNationalities.index');
    }

    public function destroy($id)
    {
        $uae = VisaUaeNationality::findOrFail($id);
        try {

            $uae->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.uaeNationalities.index');
    }

    public function showConfigForm()
    {
        $requirements = VisaRequirement::orderBy('id', 'DESC')->get();
        $nationalities = VisaNationality::orderBy('id', 'DESC')->get();
        $nationalitiesIDs = VisaUaeCountryNationality::pluck('visa_nationality_id')->toArray();
        $requirementsIDs = VisaUaeCountryRequirement::pluck('visa_requirement_id')->toArray();
        return view('backend.visa.uae.nationality.config', compact('requirements', 'nationalities', 'nationalitiesIDs', 'requirementsIDs'));
    }

    public function saveConfig(Request $request)
    {
        if (isset($request->nationalities)) {
            VisaUaeCountryNationality::truncate();
            foreach ($request->nationalities as $nationality) {
                $dataCountryNationality['visa_nationality_id'] = $nationality;
                VisaUaeCountryNationality::create($dataCountryNationality);
            }
        }
        if (isset($request->requirements)) {
            VisaUaeCountryRequirement::truncate();
            foreach ($request->requirements as $requirement) {
                $dataCountryRequirement['visa_requirement_id'] = $requirement;
                VisaUaeCountryRequirement::create($dataCountryRequirement);
            }
        }
        return redirect()->route('admin.uaeNationalities.config');
    }

    public function showInfoForm()
    {
        $info = GeneralInformation::where('type', 'uae')->firstOrFail();
        return view('backend.visa.uae.nationality.info', compact('info'));
    }

    public function saveInfo(Request $request)
    {
        $info = GeneralInformation::where('type', 'uae')->firstOrFail();

        $dataUp = $request->all();
        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_en))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_en));
            }
            $imageName = time() . '.visainfoheaderimageen' . $info->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_ar))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_ar));
            }
            $imageName = time() . '.visainfoheaderimagear' . $info->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $info->update($dataUp);
        return redirect()->route('admin.visa.uae.nationality.info');
    }
}
