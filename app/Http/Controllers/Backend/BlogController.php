<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use App\GeneralInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    private $imagePath = "public/images/blog/";
    private $imagePathInfo = "public/images/info/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:blogs.create.en|blogs.create.ar')->only(['create','store']);
        $this->middleware('permission:blogs.edit.en|blogs.edit.ar')->only(['edit','update']);
        $this->middleware('permission:blogs.delete')->only('destroy');
        $this->middleware('permission:blogs.info')->only(['showInfoForm','saveInfo']);
    }
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(20);
        return view('backend.blog.index')->with(['blogs' => $blogs]);
    }
    public function create()
    {
        return view('backend.blog.create');
    }
    public function store(Request $request)
    {
        $dataIn = $request->all();
        $blog = Blog::create($dataIn);
        $dataUp = [];
        if ($request->has('image_en') != null) {
            $imageName = time() . '.blogimageen' . $blog->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            $imageName = time() . '.blogimagear' . $blog->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            $imageName = time() . '.blogheaderimageen' . $blog->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            $imageName = time() . '.blogheaderimagear' . $blog->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $blog->update($dataUp);
        return redirect()->route('admin.blogs.index');
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blog.edit')->with(['blog' => $blog]);
    }
    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $blog = Blog::findOrFail($id);

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $blog->image_en))) {
                File::delete(storage_path($this->imagePath . $blog->image_en));
            }
            $imageName = time() . '.blogimageen' . $blog->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;
        }

        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $blog->image_ar))) {
                File::delete(storage_path($this->imagePath . $blog->image_ar));
            }
            $imageName = time() . '.blogimagear' . $blog->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $blog->header_image_en))) {
                File::delete(storage_path($this->imagePath . $blog->header_image_en));
            }
            $imageName = time() . '.blogheaderimageen' . $blog->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $blog->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $blog->header_image_ar));
            }
            $imageName = time() . '.blogheaderimagear' . $blog->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }

        $blog->update($dataUp);
        return redirect()->route('admin.blogs.index');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index');
    }
    public function showInfoForm()
    {
        $info = GeneralInformation::where('type', 'blog')->firstOrFail();
        return view('backend.blog.info', compact('info'));
    }
    public function saveInfo(Request $request)
    {
        $info = GeneralInformation::where('type', 'blog')->firstOrFail();

        $dataUp = $request->all();
        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_en))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_en));
            }
            $imageName = time() . '.bloginfoheaderimageen' . $info->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_ar))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_ar));
            }
            $imageName = time() . '.bloginfoheaderimagear' . $info->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $info->update($dataUp);
        return redirect()->route('admin.blogs.info');
    }
}
