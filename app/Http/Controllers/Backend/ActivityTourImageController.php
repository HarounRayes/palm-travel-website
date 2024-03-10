<?php

namespace App\Http\Controllers\Backend;

use App\ActivityTour;
use App\ActivityTourImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ActivityTourImageController extends Controller
{
    private $imagePath = "public/images/activity/";

    public function index()
    {
        if (request()->tour) {
            $images = ActivityTourImage::where('activity_tour_id', \request()->tour)->orderBy('id', 'DESC')->get();
            $tour = ActivityTour::findOrFail(\request()->tour);
            return view('backend.activity.image.index')->with(['tour' => $tour, 'images' => $images]);
        } else {
            return redirect()->route('admin.images.index');
        }
    }

    public function create()
    {
        if (request()->tour) {
            $tour = ActivityTour::findOrFail(request()->tour);
            return view('backend.activity.image.create', compact('tour'));
        } else {
            return redirect()->route('admin.images.index');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'activity_tour_id' => 'required',
            'image_path' => 'required'
        ]);
        $dataIn = $request->all();

        if ($request->has('image_path') != null) {
            $imageName = time() . '.activitytourimage.' . $request->image_path->getClientOriginalExtension();
            $request->image_path->storeAs($this->imagePath, $imageName);
            $dataIn['image_path'] = $imageName;
        }

        ActivityTourImage::create($dataIn);
        return redirect()->route('admin.images.index', ['tour' => $request->activity_tour_id]);
    }

    public function edit($id)
    {
        $image = ActivityTourImage::findOrFail($id);
        $tour = ActivityTour::findOrFail($image->activity_tour_id);
        return view('backend.activity.image.edit', compact('image','tour'));
    }

    public function update(Request $request, $id)
    {
        $image = ActivityTourImage::findOrFail($id);
        $dataUp = $request->all();
        if ($request->has('image_path') != null) {
            if (File::exists(storage_path($this->imagePath . $image->image_path))) {
                File::delete(storage_path($this->imagePath . $image->image_path));
            }
            $imageName = time() . '.activitytourimage.' . $request->image_path->getClientOriginalExtension();
            $request->image_path->storeAs($this->imagePath, $imageName);
            $dataUp['image_path'] = $imageName;
        }

        $image->update($dataUp);
        return redirect()->route('admin.images.index', ['tour' => $image->activity_tour_id]);
    }

    public function destroy($id)
    {
        $image = ActivityTourImage::findOrFail($id);
        $image->delete();
        return redirect()->route('admin.images.index', ['tour' => $image->activity_tour_id]);
    }
}
