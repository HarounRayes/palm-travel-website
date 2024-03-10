<?php

namespace App\Http\Controllers\Backend;

use App\Country;
use App\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HotelController extends Controller
{
    private $imagePath = "public/images/hotel/";
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:hotels.create.en|hotels.create.ar')->only(['create','store']);
        $this->middleware('permission:hotels.edit.en|hotels.edit.ar')->only(['edit','update']);
        $this->middleware('permission:hotels.delete')->only('destroy');
    }
    function index()
    {
        if (request()->country) {
            $country = Country::findOrFail(request()->country);
            $hotels = Hotel::where('country_id', request()->country)->orderBy('id', 'DESC')->get();
            return view('backend.hotel.index')->with(['hotels' => $hotels, 'country' => $country]);
        } else {
            $countries = Country::orderBy('id', 'DESC')->paginate(20);
            return view('backend.hotel.countries')->with(['countries' => $countries]);
        }
    }

    public function create()
    {
        $hotel = Country::findOrFail(request()->country);
        return view('backend.hotel.create')->with(['country' => $hotel]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required'
        ]);
        $dataUp = [];
        $hotel = Hotel::create($request->all());

        if ($request->has('image') != null) {
            $imageName = time() . '.hotelimage' . $hotel->id . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs($this->imagePath, $imageName);
            $dataUp['image'] = $imageName;
        }

        $hotel->update($dataUp);
        return redirect()->route('admin.hotels.index', ['country' => $request->country_id]);
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $country = Country::findOrFail($hotel->country_id);
        return view('backend.hotel.edit', compact('hotel','country'));
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        if ($request->has('image') != null) {
            if (File::exists(storage_path('/public/images/hotel/' . $hotel->image))) {
                File::delete(storage_path('/public/images/hotel/' . $hotel->image));
            }
            $imageName = time() . '.hotelimage' . $hotel->id . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs($this->imagePath, $imageName);
            $hotel->update([
                'image' => $imageName
            ]);
        }

        return redirect()->route('admin.hotels.index', ['country' => $hotel->country_id]);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return redirect()->route('admin.hotels.index', ['country' => $hotel->country_id]);
    }
}
