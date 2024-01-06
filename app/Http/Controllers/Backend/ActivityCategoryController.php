<?php

namespace App\Http\Controllers\Backend;

use App\ActivityCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityCategoryController extends Controller
{
    public function __construct()
    {

            $this->middleware('auth:admin');
            $this->middleware('permission:activities.categories.create.en|activities.categories.create.ar')->only(['create', 'store']);
            $this->middleware('permission:activities.categories.edit.en|activities.categories.edit.ar')->only(['edit', 'update']);
            $this->middleware('permission:activities.categories.delete')->only('destroy');

    }

    public function index()
    {
        $categories = ActivityCategory::orderBy('id', 'DESC')->paginate(20);
        return view('backend.activity.category.index')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('backend.activity.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required'
        ]);
        $dataIn = $request->all();
        $dataIn['created_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $category = ActivityCategory::create($dataIn);
        return redirect()->route('admin.activitycategories.index');
    }

    public function edit($id)
    {
        $category = ActivityCategory::findOrFail($id);
        return view('backend.activity.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required'
        ]);
        $dataIn = $request->all();
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $category = ActivityCategory::findOrFail($id);
        $category->update($dataIn);
        return redirect()->route('admin.activitycategories.index');
    }

    public function destroy($id)
    {
        $category = ActivityCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.activitycategories.index');
    }

    public function restorecategory($id)
    {
        $category = ActivityCategory::findOrFail($id);
        $category->restore();
        return redirect()->route('admin.activitycategories.index');
    }
}
