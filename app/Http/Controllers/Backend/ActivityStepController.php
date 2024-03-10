<?php

namespace App\Http\Controllers\Backend;

use App\ActivityStep;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ActivityStepController extends Controller
{
    private $imagePath = "public/images/activity/";
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:activities.steps.create.en|activities.steps.create.ar')->only(['create','store']);
        $this->middleware('permission:activities.steps.edit.en|activities.steps.edit.ar')->only(['edit','update']);
        $this->middleware('permission:activities.steps.delete')->only('destroy');
    }
    public function index()
    {
        $steps = ActivityStep::orderBy('id', 'DESC')->paginate(20);
        return view('backend.activity.step.index')->with(['steps' => $steps]);
    }

    public function create()
    {
        return view('backend.activity.step.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['created_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $step = ActivityStep::create($dataIn);
        $dataUp =[];
        if ($request->has('image_en') != null) {
            $imageName = time() . '.activitystepimageen' . $step->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }
        if ($request->has('image_ar') != null) {
            $imageName = time() . '.activitystepimagear' . $step->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }
        $step->update($dataUp);
        return redirect()->route('admin.steps.index');
    }

    public function edit($id)
    {
        $step = ActivityStep::findOrFail($id);
        return view('backend.activity.step.edit', compact('step'));
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $step = ActivityStep::findOrFail($id);
        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $step->image_en))) {
                File::delete(storage_path($this->imagePath . $step->image_en));
            }
            $imageName = time() . '.activitystepimageen' . $step->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataIn['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $step->image_ar))) {
                File::delete(storage_path($this->imagePath . $step->image_ar));
            }
            $imageName = time() . '.activitystepimagear' . $step->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataIn['image_ar'] = $imageName;
        }

        $step->update($dataIn);
        return redirect()->route('admin.steps.index');
    }

    public function destroy($id)
    {
        $step = ActivityStep::findOrFail($id);
        $step->delete();
        return redirect()->route('admin.steps.index');
    }

    public function restorestep($id)
    {
        $step = ActivityStep::findOrFail($id);
        $step->restore();
        return redirect()->route('admin.steps.index');
    }
}
