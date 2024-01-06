<?php

namespace App\Http\Controllers\Backend;

use App\type;
use App\Http\Controllers\Controller;
use App\VisaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class VisaTypeController extends Controller
{
    private $imagePath = "public/images/visa/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:visa.types.create.en|visa.types.create.ar')->only(['create','store']);
        $this->middleware('permission:visa.types.edit.en|visa.types.edit.ar')->only(['edit','update']);
        $this->middleware('permission:visa.types.delete')->only('destroy');
    }

    public function index()
    {
        $types = VisaType::orderBy('id', 'DESC')->paginate(20);
        return view('backend.visa.type.index')->with(['types' => $types]);
    }

    public function create()
    {
        return view('backend.visa.type.create');
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $type = VisaType::create($dataIn);
        $dataUp = [];

        if ($request->has('image_en') != null) {
            $imageName = time() . '.typeimageen' . $type->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.typeimagear' . $type->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.typeheaderimageen' . $type->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.typeheaderimagear' . $type->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $type->update($dataUp);
        return redirect()->route('admin.types.index');
    }

    public function edit($id)
    {
        $type = VisaType::findOrFail($id);
        return view('backend.visa.type.edit')->with(['type' => $type]);
    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();
        $type = VisaType::findOrFail($id);
        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $type->update($dataIn);

        $dataUp = [];
        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $type->image_en))) {
                File::delete(storage_path($this->imagePath . $type->image_en));
            }
            $imageName = time() . '.typeimageen' . $type->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $type->image_ar))) {
                File::delete(storage_path($this->imagePath . $type->image_ar));
            }
            $imageName = time() . '.typeimagear' . $type->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $type->header_image_en))) {
                File::delete(storage_path($this->imagePath . $type->header_image_en));
            }
            $imageName = time() . '.typeheaderimageen' . $type->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $type->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $type->header_image_ar));
            }
            $imageName = time() . '.typeheaderimagear' . $type->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }


        $type->update($dataUp);
        return redirect()->route('admin.types.index');
    }

    public function destroy($id)
    {
        $type = VisaType::findOrFail($id);
        $type->delete();
        return redirect()->route('admin.types.index');
    }
}
