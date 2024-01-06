<?php

namespace App\Http\Controllers\Backend;

use App\ActivityCity;
use App\ActivityCountry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityCityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:activities.cities.create.en|activities.cities.create.ar')->only(['create','store']);
        $this->middleware('permission:activities.cities.edit.en|activities.cities.edit.ar')->only(['edit','update']);
        $this->middleware('permission:activities.cities.delete')->only('destroy');
    }
    public function index()
    {
        if (request()->country) {
//            if admin
//            $cities = ActivityCity::where('activity_country_id', \request()->country)->withTrashed()->get();
            $cities = ActivityCity::where('activity_country_id', \request()->country)->orderBy('id', 'DESC')->get();
            $country = ActivityCountry::findOrFail(\request()->country);
        } else {
            $cities = ActivityCity::orderBy('id', 'DESC')->get();
            $country = null;
        }
        return view('backend.activity.city.index')->with(['cities' => $cities, 'country' => $country]);
    }

    public function create()
    {
        if (request()->country) {
            $country = ActivityCountry::findOrFail(request()->country);
            return view('backend.activity.city.create', compact('country'));
        } else {
            return redirect()->route('admin.activitycountries.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_country_id' => 'required'
        ]);

        $city = ActivityCity::create($request->all());
        return redirect()->route('admin.activitycities.index', ['country' => $request->activity_country_id]);
    }

    public function edit($id)
    {
        $city = ActivityCity::findOrFail($id);
        return view('backend.activity.city.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = ActivityCity::findOrFail($id);
        $city->update($request->all());
        return redirect()->route('admin.activitycities.index',['country' => $city->activity_country_id]);
    }

    public function destroy($id)
    {
        $city = ActivityCity::findOrFail($id);
        $city->delete();
        return redirect()->route('admin.activitycities.index', ['country' => $city->activity_country_id]);
    }
    public function restorecity($id){
        $city = ActivityCity::findOrFail($id);
        $city->restore();
        return redirect()->route('admin.activitycities.index',['country' => $city->activity_country_id]);
    }
}
