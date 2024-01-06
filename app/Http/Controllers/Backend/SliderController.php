<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    private $imagePath = "public/images/slider/";

    public function index()
    {
//            if admin
//            $sliders = Slider::withTrashed()->get();
        $sliders = Slider::orderBy('id', 'DESC')->paginate(20);
        return view('backend.slider.index')->with(['sliders' => $sliders]);
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_en' => 'required',
            'image_ar' => 'required',
            'text_en' => 'nullable',
            'text_ar' => 'nullable',
            'link_en' => 'nullable',
            'link_ar' => 'nullable',
        ]);

        $slider = Slider::create($request->all());
        $dataUp = [];

        if ($request->has('image_en') != null) {
            $imageName = time() . '.sliderimageen' . $slider->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.sliderimagear' . $slider->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }
        $slider->update($dataUp);
        return redirect()->route('admin.sliders.index');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image_en' => 'nullable',
            'image_ar' => 'nullable',
            'text_en' => 'nullable',
            'text_ar' => 'nullable',
            'link_en' => 'nullable',
            'link_ar' => 'nullable',
        ]);
        $slider = Slider::findOrFail($id);
        $slider->update($request->all());

        $dataUp = [];
        if ($request->has('image_en') != null) {
            if (File::exists(storage_path('/public/images/slider/' . $slider->image_en))) {
                File::delete(storage_path('/public/images/slider/' . $slider->image_en));
            }
            $imageName = time() . '.sliderimageen' . $slider->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path('/public/images/slider/' . $slider->image_ar))) {
                File::delete(storage_path('/public/images/slider/' . $slider->image_ar));
            }
            $imageName = time() . '.sliderimagear' . $slider->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        $slider->update($dataUp);
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('admin.sliders.index');
    }

    public function restoreslider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->restore();
        return redirect()->route('admin.sliders.index');
    }
}
