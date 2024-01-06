<?php

namespace App\Http\Controllers\Backend;

use App\GeneralInformation;
use App\Http\Controllers\Controller;
use App\VisaCountry;
use App\VisaCountryNationality;
use App\VisaExclusion;
use App\VisaInclusion;
use App\VisaOutbound;
use App\VisaOutboundNationality;
use App\VisaType;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisaOutboundController extends Controller
{
    private $imagePath = "public/images/visa/";
    private $imagePathInfo = "public/images/info/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.outbounds.create.en|visa.outbounds.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.outbounds.edit.en|visa.outbounds.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.outbounds.delete')->only('destroy');
        $this->middleware('permission:visa.info')->only(['showInfoForm','saveInfo']);
    }
    public function index()
    {
        $outbounds = VisaOutbound::orderBy('id', 'DESC')->get();
        return view('backend.visa.outbound.index')->with(['outbounds' => $outbounds]);
    }
    public function create()
    {
        $types = VisaType::orderBy('id', 'DESC')->get();
        $countries = VisaCountry::orderBy('id', 'DESC')->get();
        return view('backend.visa.outbound.create')->with(['types' => $types, 'countries' => $countries]);
    }
    public function store(Request $request)
    {
        $dataIn = $request->validate([
            'visa_country_id' => 'required',
            'visa_type_id' => 'required'
        ]);

        $dataIn['created_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $outbound = VisaOutbound::create($dataIn);
        $dataUp = [];


        if ($request->has('image_en') != null) {
            $imageName = time() . '.visaoutboundimageen' . $outbound->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.visaoutboundimagear' . $outbound->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.visaoutboundheaderimageen' . $outbound->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.visaoutboundheaderimagear' . $outbound->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $outbound->update($dataUp);

        if (isset($request->visanationality)) {
            foreach ($request->visanationality as $key => $nationality) {
                $dataOutboundNationality['visa_country_id'] = $dataIn['visa_country_id'];
                $dataOutboundNationality['visa_outbound_id'] = $outbound->id;
                $dataOutboundNationality['visa_nationality_id'] = $nationality;
                $dataOutboundNationality['price'] = $request->visanationalityprice[$key];
                VisaOutboundNationality::create($dataOutboundNationality);
            }
        }

        if (isset($request->inclusions)) {
            $inclusions = $request->inclusions;
            foreach ($inclusions['value_en'] as $key => $value) {
                $dataInclusion['value_en'] = $value;
                $dataInclusion['value_ar'] = $inclusions['value_ar'][$key];
                $dataInclusion['visa_outbound_id'] = $outbound->id;
                VisaInclusion::create($dataInclusion);
            }
        }
        if (isset($request->exclusions)) {
            $exclusions = $request->exclusions;
            foreach ($exclusions['value_en'] as $key1 => $value1) {
                $dataExclusion['value_en'] = $value1;
                $dataExclusion['value_ar'] = $exclusions['value_ar'][$key1];
                $dataExclusion['visa_outbound_id'] = $outbound->id;
                VisaExclusion::create($dataExclusion);
            }
        }
        return redirect()->route('admin.outbounds.index');
    }
    public function edit($id)
    {
        $outbound = VisaOutbound::findOrFail($id);
        $types = VisaType::orderBy('id', 'DESC')->get();
        $countries = VisaCountry::orderBy('id', 'DESC')->get();
        $nationalities = VisaCountryNationality::where('visa_country_id', $outbound->visa_country_id)->orderBy('id', 'DESC')->get();
        return view('backend.visa.outbound.edit', compact('outbound', 'types', 'countries', 'nationalities'));
    }
    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $outbound = VisaOutbound::findOrFail($id);
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $outbound->update($dataIn);
        $dataUp = [];
        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $outbound->image_en))) {
                File::delete(storage_path($this->imagePath . $outbound->image_en));
            }
            $imageName = time() . '.visaoutboundimageen' . $outbound->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $outbound->image_ar))) {
                File::delete(storage_path($this->imagePath . $outbound->image_ar));
            }
            $imageName = time() . '.visaoutboundimagear' . $outbound->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $outbound->header_image_en))) {
                File::delete(storage_path($this->imagePath . $outbound->header_image_en));
            }
            $imageName = time() . '.visaoutboundheaderimageen' . $outbound->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $outbound->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $outbound->header_image_ar));
            }
            $imageName = time() . '.visaoutboundheaderimagear' . $outbound->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $outbound->update($dataUp);

        if (isset($request->visanationality)) {
            VisaOutboundNationality::where('visa_outbound_id', $id)->delete();
            foreach ($request->visanationality as $key => $nationality) {
                $dataOutboundNationality['visa_country_id'] = $dataIn['visa_country_id'];
                $dataOutboundNationality['visa_outbound_id'] = $outbound->id;
                $dataOutboundNationality['visa_nationality_id'] = $nationality;
                $dataOutboundNationality['price'] = $request->visanationalityprice[$key];
                VisaOutboundNationality::create($dataOutboundNationality);
            }
        }
        if (isset($request->inclusions)) {
            VisaInclusion::where('visa_outbound_id', $id)->delete();
            $inclusions = $request->inclusions;
            foreach ($inclusions['value_en'] as $key => $value) {
                $dataInclusion['value_en'] = $value;
                $dataInclusion['value_ar'] = $inclusions['value_ar'][$key];
                $dataInclusion['visa_outbound_id'] = $id;
                VisaInclusion::create($dataInclusion);
            }
        }
        if (isset($request->exclusions)) {
            VisaExclusion::where('visa_outbound_id', $id)->delete();
            $exclusions = $request->exclusions;
            foreach ($exclusions['value_en'] as $key1 => $value1) {
                $dataExclusion['value_en'] = $value1;
                $dataExclusion['value_ar'] = $exclusions['value_ar'][$key1];
                $dataExclusion['visa_outbound_id'] = $id;
                VisaExclusion::create($dataExclusion);
            }
        }
        return redirect()->route('admin.outbounds.index');
    }
    public function destroy($id)
    {
        $outbound = VisaOutbound::findOrFail($id);
        try {
            VisaOutboundNationality::where('visa_outbound_id', $id)->delete();
            $outbound->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.outbounds.index');
    }
    public function showInfoForm()
    {
        $info = GeneralInformation::where('type', 'visa')->firstOrFail();
        return view('backend.visa.outbound.info', compact('info'));
    }
    public function saveInfo(Request $request)
    {
        $info = GeneralInformation::where('type', 'visa')->firstOrFail();

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
        return redirect()->route('admin.visa.info');
    }
}
