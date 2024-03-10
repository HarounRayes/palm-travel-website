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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class VisaUaeController extends Controller
{
    private $imagePath = "public/images/visa/";
    private $imagePathInfo = "public/images/info/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.uae.create.en|visa.uae.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.uae.edit.en|visa.uae.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.uae.delete')->only('destroy');
        $this->middleware('permission:visa.uae.requirements')->only(['showConfigForm','saveConfig']);
        $this->middleware('permission:visa.info')->only(['showInfoForm','saveInfo']);
    }

    public function index()
    {
        $uaes = VisaUae::orderBy('id', 'DESC')->get();
        return view('backend.visa.uae.index')->with(['uaes' => $uaes]);
    }
    public function create()
    {
        $types = VisaType::orderBy('id', 'DESC')->get();
        $nationalities = VisaUaeCountryNationality::orderBy('id', 'DESC')->get();
        return view('backend.visa.uae.create')->with(['types' => $types, 'nationalities' => $nationalities]);
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();

        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $uae = VisaUae::create($dataIn);
        $dataUp = [];


        if ($request->has('image_en') != null) {
            $imageName = time() . '.visauaeimageen' . $uae->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.visauaeimagear' . $uae->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.visauaeheaderimageen' . $uae->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.visauaeheaderimagear' . $uae->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $uae->update($dataUp);

        if (isset($request->visanationality)) {
            foreach ($request->visanationality as $key => $nationality) {
                $dataOutboundNationality['visa_uae_id'] = $uae->id;
                $dataOutboundNationality['visa_nationality_id'] = $nationality;
                $dataOutboundNationality['price'] = $request->visanationalityprice[$key];
                VisaUaeNationality::create($dataOutboundNationality);
            }
        }

        if (isset($request->inclusions)) {
            $inclusions = $request->inclusions;
            foreach ($inclusions['value_en'] as $key => $value) {
                $dataInclusion['value_en'] = $value;
                $dataInclusion['value_ar'] = $inclusions['value_ar'][$key];
                $dataInclusion['visa_uae_id'] = $uae->id;
                VisaUaeInclusion::create($dataInclusion);
            }
        }
        if (isset($request->exclusions)) {
            $exclusions = $request->exclusions;
            foreach ($exclusions['value_en'] as $key1 => $value1) {
                $dataExclusion['value_en'] = $value1;
                $dataExclusion['value_ar'] = $exclusions['value_ar'][$key1];
                $dataExclusion['visa_uae_id'] = $uae->id;
                VisaUaeExclusion::create($dataExclusion);
            }
        }
        return redirect()->route('admin.uaes.index');
    }

    public function edit($id)
    {
        $uae = VisaUae::findOrFail($id);
        $types = VisaType::orderBy('id', 'DESC')->get();
        $nationalities = VisaUaeCountryNationality::orderBy('id', 'DESC')->get();
        return view('backend.visa.uae.edit', compact('uae', 'types', 'nationalities'));
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $uae = VisaUae::findOrFail($id);
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $uae->image_en))) {
                File::delete(storage_path($this->imagePath . $uae->image_en));
            }
            $imageName = time() . '.visauaeimageen' . $uae->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataIn['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $uae->image_ar))) {
                File::delete(storage_path($this->imagePath . $uae->image_ar));
            }
            $imageName = time() . '.visauaeimagear' . $uae->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataIn['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $uae->header_image_en))) {
                File::delete(storage_path($this->imagePath . $uae->header_image_en));
            }
            $imageName = time() . '.visauaeheaderimageen' . $uae->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataIn['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $uae->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $uae->header_image_ar));
            }
            $imageName = time() . '.visauaeheaderimagear' . $uae->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataIn['header_image_ar'] = $imageName;
        }
        $uae->update($dataIn);

        if (isset($request->visanationality)) {
            VisaUaeNationality::where('visa_uae_id', $id)->delete();
            foreach ($request->visanationality as $key => $nationality) {
                $dataOutboundNationality['visa_uae_id'] = $uae->id;
                $dataOutboundNationality['visa_nationality_id'] = $nationality;
                $dataOutboundNationality['price'] = $request->visanationalityprice[$key];
                VisaUaeNationality::create($dataOutboundNationality);
            }
        }
        if (isset($request->inclusions)) {
            VisaUaeInclusion::where('visa_uae_id', $id)->delete();
            $inclusions = $request->inclusions;
            foreach ($inclusions['value_en'] as $key => $value) {
                $dataInclusion['value_en'] = $value;
                $dataInclusion['value_ar'] = $inclusions['value_ar'][$key];
                $dataInclusion['visa_uae_id'] = $id;
                VisaUaeInclusion::create($dataInclusion);
            }
        }
        if (isset($request->exclusions)) {
            VisaUaeExclusion::where('visa_uae_id', $id)->delete();
            $exclusions = $request->exclusions;
            foreach ($exclusions['value_en'] as $key1 => $value1) {
                $dataExclusion['value_en'] = $value1;
                $dataExclusion['value_ar'] = $exclusions['value_ar'][$key1];
                $dataExclusion['visa_uae_id'] = $id;
                VisaUaeExclusion::create($dataExclusion);
            }
        }
        return redirect()->route('admin.uaes.index');
    }

    public function destroy($id)
    {
        $uae = VisaUae::findOrFail($id);
        try {
            VisaUaeNationality::where('visa_uae_id', $id)->delete();
            $uae->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.uaes.index');
    }

    public function showConfigForm()
    {
        $requirements = VisaRequirement::orderBy('id', 'DESC')->get();
        $nationalities = VisaNationality::orderBy('id', 'DESC')->get();
        $nationalitiesIDs = VisaUaeCountryNationality::pluck('visa_nationality_id')->toArray();
        $requirementsIDs = VisaUaeCountryRequirement::pluck('visa_requirement_id')->toArray();
        return view('backend.visa.uae.config', compact('requirements', 'nationalities' ,'nationalitiesIDs' ,'requirementsIDs'));
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
        return redirect()->route('admin.uaes.config');
    }

    public function showInfoForm()
    {
        $info = GeneralInformation::where('type', 'uae')->firstOrFail();
        return view('backend.visa.uae.info', compact('info'));
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
        return redirect()->route('admin.visa.uae.info');
    }
}
