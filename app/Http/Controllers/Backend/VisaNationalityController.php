<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\VisaNationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisaNationalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.nationalities.create.en|visa.nationalities.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.nationalities.edit.en|visa.nationalities.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.nationalities.delete')->only('destroy');
    }
    public function index()
    {
//            if admin
//            $cities = City::where('country_id', \request()->country)->withTrashed()->get();
        $nationalities = VisaNationality::orderBy('id', 'DESC')->get();
        return view('backend.visa.nationality.index')->with(['nationalities' => $nationalities]);
    }

    public function create()
    {
        return view('backend.visa.nationality.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['created_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $nationality = VisaNationality::create($dataIn);
        return redirect()->route('admin.nationalities.index');
    }

    public function edit($id)
    {
        $nationality = VisaNationality::findOrFail($id);
        return view('backend.visa.nationality.edit', compact('nationality'));
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $nationality = VisaNationality::findOrFail($id);
        $nationality->update($dataIn);
        return redirect()->route('admin.nationalities.index');
    }

    public function destroy($id)
    {
        $nationality = VisaNationality::findOrFail($id);
        $nationality->delete();
        return redirect()->route('admin.nationalities.index');
    }

    public function restorecity($id)
    {
        $nationality = VisaNationality::findOrFail($id);
        $nationality->restore();
        return redirect()->route('admin.nationalities.index');
    }
}
