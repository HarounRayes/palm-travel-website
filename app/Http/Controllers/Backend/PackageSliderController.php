<?php

namespace App\Http\Controllers\Backend;

use App\Package;
use App\PackageSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PackageSliderController extends Controller
{
    private $imagePath = "public/images/slider/";

    public function index()
    {
//            if admin
//            $sliders = PackageSlider::withTrashed()->get();
        if (request()->package) {
            $package = Package::findOrFail(request()->package);
            $sliders = PackageSlider::where('package_id' , \request()->package)->orderBy('id', 'DESC')->get();
            return view('backend.packageslider.index')->with(['sliders' => $sliders,'package' => $package]);
        }else {
            return redirect()->route('admin.packages.index');
        }
    }

    public function create()
    {
        if (request()->package) {
            $package = Package::findOrFail(request()->package);
            return view('backend.packageslider.create')->with(['package' => $package]);
        }else {
            return redirect()->route('admin.packages.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_en' => 'required',
            'image_ar' => 'required',
            'text_en' => 'nullable',
            'text_ar' => 'nullable'
        ]);

        $slider = PackageSlider::create($request->all());
        $dataUp = [];

        if ($request->has('image_en') != null) {
            $imageName = time() . '.blocksliderimageen' . $slider->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.blocksliderimagear' . $slider->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }
        $slider->update($dataUp);
        return redirect()->route('admin.packages.sliders.index',['package' => $slider->package_id]);
    }

    public function edit($package,$slider)
    {
        $slider = PackageSlider::findOrFail($slider);
        return view('backend.packageslider.edit')->with(['slider' => $slider]);
    }

    public function update(Request $request, $package,$slider)
    {
        $request->validate([
            'image_en' => 'nullable',
            'image_ar' => 'nullable',
            'text_en' => 'nullable',
            'text_ar' => 'nullable'
        ]);
        $slider = PackageSlider::findOrFail($slider);
        $slider->update($request->all());

        $dataUp = [];
        if ($request->has('image_en') != null) {
            if (File::exists(storage_path('/public/images/slider/' . $slider->image_en))) {
                File::delete(storage_path('/public/images/slider/' . $slider->image_en));
            }
            $imageName = time() . '.blocksliderimageen' . $slider->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path('/public/images/slider/' . $slider->image_ar))) {
                File::delete(storage_path('/public/images/slider/' . $slider->image_ar));
            }
            $imageName = time() . '.blocksliderimagear' . $slider->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        $slider->update($dataUp);
        return redirect()->route('admin.packages.sliders.index',['package' => $slider->package_id]);
    }

    public function destroy($package,$slider)
    {
        $slider = PackageSlider::findOrFail($slider);
        $slider->delete();
        return redirect()->route('admin.packages.sliders.index',['package' => $slider->package_id]);
    }

    public function restoreslider($package,$slider)
    {
        $slider = PackageSlider::findOrFail($slider);
        $slider->restore();
        return redirect()->route('admin.packages.sliders.index',['package' => $slider->package_id]);
    }
}
