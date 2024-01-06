<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\VisaCountry;
use App\VisaCountryNationality;
use App\VisaCountryRequirement;
use App\VisaNationality;
use App\VisaRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class VisaCountryController extends Controller
{
    private $imagePath = "public/images/visa/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.countries.create.en|visa.countries.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.countries.edit.en|visa.countries.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.countries.delete')->only('destroy');
    }

    public function index()
    {
        $countries = VisaCountry::orderBy('id', 'DESC')->get();
        return view('backend.visa.country.index')->with(['countries' => $countries]);
    }

    public function create()
    {
        $nationalities = VisaNationality::orderBy('id', 'DESC')->get();
        $requirements = VisaRequirement::orderBy('id', 'DESC')->get();
        return view('backend.visa.country.create')->with(['nationalities' => $nationalities, 'requirements' => $requirements]);
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();

        $country = VisaCountry::create($dataIn);
        $dataUp = [];

        if ($request->has('flag') != null) {
            $imageName = time() . '.visacountryflag' . $country->id . '.' . $request->flag->getClientOriginalExtension();
            $request->flag->storeAs($this->imagePath, $imageName);
            $dataUp['flag'] = $imageName;
        }

        if ($request->has('image_en') != null) {
            $imageName = time() . '.visacountryimageen' . $country->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.visacountryimagear' . $country->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.visacountryheaderimageen' . $country->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.visacountryheaderimagear' . $country->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $country->update($dataUp);
        if (isset($request->nationalities)) {
            foreach ($request->nationalities as $nationality) {
                $dataCountryNationality['visa_country_id'] = $country->id;
                $dataCountryNationality['visa_nationality_id'] = $nationality;
                VisaCountryNationality::create($dataCountryNationality);
            }
        }
        if (isset($request->requirements)) {
            foreach ($request->requirements as $requirement) {
                $dataCountryRequirement['visa_country_id'] = $country->id;
                $dataCountryRequirement['visa_requirement_id'] = $requirement;
                VisaCountryRequirement::create($dataCountryRequirement);
            }
        }
        return redirect()->route('admin.visacountries.index');
    }

    public function edit($id)
    {
        $country = VisaCountry::findOrFail($id);
        $nationalities = VisaNationality::orderBy('id', 'DESC')->get();
        $requirements = VisaRequirement::orderBy('id', 'DESC')->get();
        return view('backend.visa.country.edit', compact('country', 'nationalities', 'requirements'));
    }

    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $country = VisaCountry::findOrFail($id);
    //    $country->update($request->all());

        if ($request->has('flag') != null) {
            if (File::exists(storage_path($this->imagePath . $country->flag))) {
                File::delete(storage_path($this->imagePath . $country->flag));
            }
            $imageName = time() . '.visacountryflag' . $country->id . '.' . $request->flag->getClientOriginalExtension();
            $request->flag->storeAs($this->imagePath, $imageName);
            $dataUp['flag'] = $imageName;
        }

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $country->image_en))) {
                File::delete(storage_path($this->imagePath . $country->image_en));
            }
            $imageName = time() . '.visacountryimageen' . $country->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $country->image_ar))) {
                File::delete(storage_path($this->imagePath . $country->image_ar));
            }
            $imageName = time() . '.visacountryimagear' . $country->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $country->header_image_en))) {
                File::delete(storage_path($this->imagePath . $country->header_image_en));
            }
            $imageName = time() . '.visacountryheaderimageen' . $country->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $country->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $country->header_image_ar));
            }
            $imageName = time() . '.visacountryheaderimagear' . $country->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $country->update($dataUp);
        if (isset($request->nationalities)) {
            VisaCountryNationality::where('visa_country_id', $id)->delete();
            foreach ($request->nationalities as $nationality) {
                $dataCountryNationality['visa_country_id'] = $country->id;
                $dataCountryNationality['visa_nationality_id'] = $nationality;
                VisaCountryNationality::create($dataCountryNationality);
            }
        }
        if (isset($request->requirements)) {
            VisaCountryRequirement::where('visa_country_id', $id)->delete();
            foreach ($request->requirements as $requirement) {
                $dataCountryRequirement['visa_country_id'] = $country->id;
                $dataCountryRequirement['visa_requirement_id'] = $requirement;
                VisaCountryRequirement::create($dataCountryRequirement);
            }
        }
        return redirect()->route('admin.visacountries.index');
    }

    public function destroy($id)
    {
        $country = VisaCountry::findOrFail($id);
        try {
            VisaCountryNationality::where('visa_country_id', $id)->delete();
            VisaCountryRequirement::where('visa_country_id', $id)->delete();
            $country->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.countries.index');
    }
}
