<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    private $imagePath = "public/images/country/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:countries.create.en|countries.create.ar')->only(['create','store']);
        $this->middleware('permission:countries.edit.en|countries.edit.ar')->only(['edit','update']);
        $this->middleware('permission:countries.delete')->only('destroy');
        $this->middleware('permission:countries.order')->only(['showOrderForm','saveOrder']);
    }

    public function index()
    {
        $countries = Country::orderBy('id', 'DESC')->paginate(20);
        return view('backend.country.index')->with(['countries' => $countries]);
    }

    public function create()
    {
        return view('backend.country.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();

        $country = Country::create($dataIn);
        $dataUp = [];

        if ($request->has('flag') != null) {
            $imageName = time() . '.countryflag' . $country->id . '.' . $request->flag->getClientOriginalExtension();
            $request->flag->storeAs($this->imagePath, $imageName);
            $dataUp['flag'] = $imageName;
        }

        if ($request->has('image_en') != null) {
            $imageName = time() . '.countryimageen' . $country->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.countryimagear' . $country->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.countryheaderimageen' . $country->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.countryheaderimagear' . $country->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }

        if ($request->has('background_image_en') != null) {
            $imageName = time() . '.countryheaderimageen' . $country->id . '.' . $request->background_image_en->getClientOriginalExtension();
            $request->background_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['background_image_en'] = $imageName;
        }

        if ($request->has('background_image_ar') != null) {
            $imageName = time() . '.countryheaderimagear' . $country->id . '.' . $request->background_image_ar->getClientOriginalExtension();
            $request->background_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['background_image_ar'] = $imageName;
        }


        $country->update($dataUp);
        return redirect()->route('admin.countries.index');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('backend.country.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $country = Country::findOrFail($id);

        if ($request->has('flag') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->flag))) {
                File::delete(storage_path('/public/images/country/' . $country->flag));
            }
            $imageName = time() . '.countryflag' . $country->id . '.' . $request->flag->getClientOriginalExtension();
            $request->flag->storeAs($this->imagePath, $imageName);
            $dataUp['flag'] = $imageName;
        }

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->image_en))) {
                File::delete(storage_path('/public/images/country/' . $country->image_en));
            }
            $imageName = time() . '.countryimageen' . $country->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->image_ar))) {
                File::delete(storage_path('/public/images/country/' . $country->image_ar));
            }
            $imageName = time() . '.countryimagear' . $country->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->header_image_en))) {
                File::delete(storage_path('/public/images/country/' . $country->header_image_en));
            }
            $imageName = time() . '.countryheaderimageen' . $country->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->header_image_ar))) {
                File::delete(storage_path('/public/images/country/' . $country->header_image_ar));
            }
            $imageName = time() . '.countryheaderimagear' . $country->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }

        if ($request->has('background_image_en') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->background_image_en))) {
                File::delete(storage_path('/public/images/country/' . $country->background_image_en));
            }
            $imageName = time() . '.countryheaderimageen' . $country->id . '.' . $request->background_image_en->getClientOriginalExtension();
            $request->background_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['background_image_en'] = $imageName;
        }

        if ($request->has('background_image_ar') != null) {
            if (File::exists(storage_path('/public/images/country/' . $country->background_image_ar))) {
                File::delete(storage_path('/public/images/country/' . $country->background_image_ar));
            }
            $imageName = time() . '.countryheaderimagear' . $country->id . '.' . $request->background_image_ar->getClientOriginalExtension();
            $request->background_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['background_image_ar'] = $imageName;
        }

        $country->update($dataUp);

        return redirect()->route('admin.countries.index');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        try {
//            $cities = $country->cities();
//            $tours = $country->tours();
//            $hotels = $country->hotels();
//            $cities->delete();
//            $tours->delete();
//            $hotels->delete();
            $country->delete();
        } catch (\Exception $e) {
            throw $e;
        }
        return redirect()->route('admin.countries.index');
    }

    public function showOrderForm()
    {
        $countries = Country::orderBy('country_order', 'ASC')->get();
        return view('backend.country.order', compact('countries'));
    }

    public function saveOrder(Request $request)
    {
        if (isset($request->country)) {
            $countries = $request->country;
            foreach ($countries as $id => $order) {
                $country = Country::findOrFail($id);
                $country->update(['country_order' => $order]);
            }
        }
        return redirect()->route('admin.countries.order');
    }
}
