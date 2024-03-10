<?php

namespace App\Http\Controllers\Backend;

use App\type;
use App\Http\Controllers\Controller;
use App\VisaUaeRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VisaUaeRequirementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.uaeRequirements.create.en|visa.uaeRequirements.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.uaeRequirements.edit.en|visa.uaeRequirements.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.uaeRequirements.delete')->only('destroy');
    }

    public function index()
    {
        $requirements = VisaUaeRequirement::document()->orderBy('id', 'DESC')->paginate(20);
        return view('backend.visa.uae.requirement.index')->with(['requirements' => $requirements]);
    }

    public function create()
    {
        return view('backend.visa.uae.requirement.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['document'] = 1;
        $dataIn['type'] = 'file';
        VisaUaeRequirement::create($dataIn);
        return redirect()->route('admin.uaeRequirements.index');
    }

    public function edit($id)
    {
        $requirement = VisaUaeRequirement::findOrFail($id);
        return view('backend.visa.uae.requirement.edit')->with(['type' => $requirement]);
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $requirement = VisaUaeRequirement::findOrFail($id);
        $requirement->update($dataIn);
        return redirect()->route('admin.uaeRequirements.index');
    }

    public function destroy($id)
    {
        $requirement = VisaUaeRequirement::findOrFail($id);
        $requirement->delete();
        return redirect()->route('admin.uaeRequirements.index');
    }
}
