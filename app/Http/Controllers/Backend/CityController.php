<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:cities.create.en|cities.create.ar')->only(['create','store']);
        $this->middleware('permission:cities.edit.en|cities.edit.ar')->only(['edit','update']);
        $this->middleware('permission:cities.delete')->only('destroy');
    }
    public function index()
    {
        if (request()->country) {
//            if admin
//            $cities = City::where('country_id', \request()->country)->withTrashed()->get();
            $cities = City::where('country_id', \request()->country)->orderBy('id', 'DESC')->get();
            $country = Country::findOrFail(\request()->country);
        } else {
            $cities = City::orderBy('id', 'DESC')->get();
            $country = null;
        }
        return view('backend.city.index')->with(['cities' => $cities, 'country' => $country]);
    }

    public function create()
    {
        if (request()->country) {
            $country = Country::findOrFail(request()->country);
            return view('backend.city.create', compact('country'));
        } else {
            return redirect()->route('admin.countries.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required'
        ]);

        $city = City::create($request->all());
        return redirect()->route('admin.cities.index', ['country' => $request->country_id]);
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('backend.city.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        return redirect()->route('admin.cities.index',['country' => $city->country_id]);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->route('admin.cities.index', ['country' => $city->country_id]);
    }
    public function restorecity($id){
        $city = City::findOrFail($id);
        $city->restore();
        return redirect()->route('admin.cities.index',['country' => $city->country_id]);
    }
}
