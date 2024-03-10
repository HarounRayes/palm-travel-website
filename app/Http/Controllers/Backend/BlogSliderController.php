<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\BlogSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogSliderController extends Controller
{
    private $imagePath = "public/images/slider/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:blogs.slider');
    }
    public function index()
    {
//            if admin
//            $sliders = BlogSlider::withTrashed()->get();
        if (request()->blog) {
            $blog = blog::findOrFail(request()->blog);
            $sliders = BlogSlider::where('blog_id' , \request()->blog)->orderBy('id', 'DESC')->get();
            return view('backend.blogslider.index')->with(['sliders' => $sliders,'blog' => $blog]);
        }else {
            return redirect()->route('admin.blogs.index');
        }
    }

    public function create()
    {
        if (request()->blog) {
            $blog = blog::findOrFail(request()->blog);
            return view('backend.blogslider.create')->with(['blog' => $blog]);
        }else {
            return redirect()->route('admin.blogs.index');
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

        $slider = BlogSlider::create($request->all());
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
        return redirect()->route('admin.blogs.sliders.index',['blog' => $slider->blog_id]);
    }

    public function edit($blog,$slider)
    {
        $slider = BlogSlider::findOrFail($slider);
        return view('backend.blogslider.edit')->with(['slider' => $slider]);
    }

    public function update(Request $request, $blog,$slider)
    {
        $request->validate([
            'image_en' => 'nullable',
            'image_ar' => 'nullable',
            'text_en' => 'nullable',
            'text_ar' => 'nullable'
        ]);
        $slider = BlogSlider::findOrFail($slider);
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
        return redirect()->route('admin.blogs.sliders.index',['blog' => $slider->blog_id]);
    }

    public function destroy($blog,$slider)
    {
        $slider = BlogSlider::findOrFail($slider);
        $slider->delete();
        return redirect()->route('admin.blogs.sliders.index',['blog' => $slider->blog_id]);
    }

    public function restoreslider($blog,$slider)
    {
        $slider = BlogSlider::findOrFail($slider);
        $slider->restore();
        return redirect()->route('admin.blogs.sliders.index',['blog' => $slider->blog_id]);
    }
}
