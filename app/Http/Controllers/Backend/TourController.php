<?php


namespace App\Http\Controllers\Backend;


use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TourController extends Controller
{
    private $imagePath = "public/images/tour/";
    public function index()
    {
        if (request()->country) {
//            if admin
//            $cities = City::where('country_id', \request()->country)->withTrashed()->get();
            $tours = Tour::where('country_id', \request()->country)->orderBy('id', 'DESC')->get();
            $country = Country::findOrFail(request()->country);
            return view('backend.tour.index')->with(['tours' => $tours ,'country' => $country]);
        } else {
            return redirect()->route('admin.countries.index');
        }
    }
    public function create()
    {
        if (request()->country) {
            $country = Country::findOrFail(request()->country);
            $cities = City::where('country_id', \request()->country)->orderBy('id', 'DESC')->get();

            return view('backend.tour.create', compact('country','cities'));
        } else {
            return redirect()->route('admin.countries.index');
        }
    }
    public function store(Request $request)
    {
       $tour = Tour::create($request->all());
        $dataUp = [];

        if ($request->has('image_en') != null) {
            $imageName = time() . '.tourimageen' . $tour->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;

        }
        if ($request->has('image_ar') != null) {
            $imageName = time() . '.tourimagear' . $tour->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        $tour->update($dataUp);
        return redirect()->route('admin.tours.index', ['country' => $request->country_id]);
    }

    public function edit($id){
        $tour = Tour::findOrFail($id);
        $cities = City::where('country_id' , $tour->country_id)->orderBy('id', 'DESC')->get();
        return view('backend.tour.edit', compact('tour','cities'));
    }

    public function update(Request $request,$id){

        $tour = Tour::findOrFail($id);
        $tour->update($request->all());

        if (isset($request->is_car) && $request->is_car == '1') {
            $tour->update(['is_car' => '1']);
        } else {
            $tour->update(['is_car' => '0']);
        }

        if (isset($request->is_bus) && $request->is_bus == '1') {
            $tour->update(['is_bus' => '1']);
        } else {
            $tour->update(['is_bus' => '0']);
        }

        $dataUp = [];

        if ($request->has('image_en') != null) {
            if (File::exists(storage_path('/public/images/tour/' . $tour->image_en))) {
                File::delete(storage_path('/public/images/tour/' . $tour->image_en));
            }
            $imageName = time() . '.tourimageen' . $tour->id . '.' . $request->image_en->getClientOriginalExtension();
            $request->image_en->storeAs($this->imagePath, $imageName);
            $dataUp['image_en'] = $imageName;

        }
        if ($request->has('image_ar') != null) {
            if (File::exists(storage_path('/public/images/tour/' . $tour->image_ar))) {
                File::delete(storage_path('/public/images/tour/' . $tour->image_ar));
            }
            $imageName = time() . '.tourimagear' . $tour->id . '.' . $request->image_ar->getClientOriginalExtension();
            $request->image_ar->storeAs($this->imagePath, $imageName);
            $dataUp['image_ar'] = $imageName;
        }

        $tour->update($dataUp);

        return redirect()->route('admin.tours.index', ['country' => $tour->country_id]);
    }
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        return redirect()->route('admin.tours.index', ['country' => $tour->country_id]);
    }
}
