<?php

namespace App\Http\Controllers\Backend;

use App\ActivityCountry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:activities.countries.create.en|activities.countries.create.ar')->only(['create','store']);
        $this->middleware('permission:activities.countries.edit.en|activities.countries.edit.ar')->only(['edit','update']);
        $this->middleware('permission:activities.countries.delete')->only('destroy');
    }

    public function index()
    {
        $countries = ActivityCountry::orderBy('id', 'DESC')->paginate(20);
        return view('backend.activity.country.index')->with(['countries' => $countries]);
    }

    public function create()
    {
        return view('backend.activity.country.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['created_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $country = ActivityCountry::create($dataIn);
        return redirect()->route('admin.activitycountries.index');
    }

    public function edit($id)
    {
        $country = ActivityCountry::findOrFail($id);
        return view('backend.activity.country.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $country = ActivityCountry::findOrFail($id);
        $country->update($dataIn);
        return redirect()->route('admin.activitycountries.index');
    }

    public function destroy($id)
    {
        $country = ActivityCountry::findOrFail($id);
        $country->delete();
        return redirect()->route('admin.activitycountries.index');
    }

    public function restorecountry($id)
    {
        $country = ActivityCountry::findOrFail($id);
        $country->restore();
        return redirect()->route('admin.activitycountries.index');
    }
}
