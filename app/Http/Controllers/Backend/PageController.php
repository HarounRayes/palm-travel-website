<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    private $imagePath = "public/images/page/";
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:pages.edit.en|pages.edit.ar')->only(['edit','update']);
    }
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('backend.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'text_en' => 'nullable',
            'text_ar' => 'nullable',
            'header_image_en' => 'nullable',
            'header_image_ar' => 'nullable',

        ]);
        $page = Page::findOrFail($id);
        $page->update($request->all());
        $dataUp = [];

        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePath . $page->header_image_en))) {
                File::delete(storage_path($this->imagePath . $page->header_image_en));
            }
            $imageName = time() . '.pageheaderimageen' . $page->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePath . $page->header_image_ar))) {
                File::delete(storage_path($this->imagePath . $page->header_image_ar));
            }
            $imageName = time() . '.pageheaderimagear' . $page->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $page->update($dataUp);

        return redirect()->route('admin.pages.edit', $id);
    }
}
