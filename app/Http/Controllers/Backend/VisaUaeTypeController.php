<?php

namespace App\Http\Controllers\Backend;

use App\type;
use App\Http\Controllers\Controller;
use App\VisaUaeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VisaUaeTypeController extends Controller
{
    private $imagePath = "public/images/visa/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.uaeTypes.create.en|visa.uaeTypes.create.ar')->only(['create', 'store']);
        $this->middleware('permission:visa.uaeTypes.edit.en|visa.uaeTypes.edit.ar')->only(['edit', 'update']);
        $this->middleware('permission:visa.uaeTypes.delete')->only('destroy');
    }

    public function index()
    {
        $types = VisaUaeType::orderBy('id', 'DESC')->paginate(20);
        return view('backend.visa.uae.type.index')->with(['types' => $types]);
    }

    public function create()
    {
        return view('backend.visa.uae.type.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $type = VisaUaeType::create($dataIn);

        $dataUp =[];

        if ($request->has('image_en') != null) {
            $imageName = time() . '.typeimageen' . $type->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.typeimagear' . $type->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }
        $type->update($dataUp);
        return redirect()->route('admin.uaeTypes.index');
    }

    public function edit($id)
    {
        $type = VisaUaeType::findOrFail($id);
        return view('backend.visa.uae.type.edit')->with(['type' => $type]);
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $type = VisaUaeType::findOrFail($id);
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $type->image_en))) {
                File::delete(storage_path($this->imagePath . $type->image_en));
            }
            $imageName = time() . '.typeimageen' . $type->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataIn['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $type->image_ar))) {
                File::delete(storage_path($this->imagePath . $type->image_ar));
            }
            $imageName = time() . '.typeimagear' . $type->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataIn['image_ar'] = $imageName;
        }

        $type->update($dataIn);
        return redirect()->route('admin.uaeTypes.index');
    }

    public function destroy($id)
    {
        $type = VisaUaeType::findOrFail($id);
        $type->delete();
        return redirect()->route('admin.uaeTypes.index');
    }
}
