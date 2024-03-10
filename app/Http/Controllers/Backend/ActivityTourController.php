<?php

namespace App\Http\Controllers\Backend;

use App\ActivityCategory;
use App\ActivityCity;
use App\ActivityCountry;
use App\ActivityExclusion;
use App\ActivityInclusion;
use App\ActivityTour;
use App\ActivityTourCategory;
use App\ActivityTourType;
use App\ActivityType;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use League\Flysystem\Exception;

class ActivityTourController extends Controller
{

    private $imagePath = "public/images/activity/";
    private $imagePathInfo = "public/images/info/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:activities.tours.create.en|activities.tours.create.ar')->only(['create', 'store']);
        $this->middleware('permission:activities.tours.edit.en|activities.tours.edit.ar')->only(['edit', 'update']);
        $this->middleware('permission:activities.tours.delete')->only('destroy');
        $this->middleware('permission:activities.info')->only(['showInfoForm', 'saveInfo']);
    }

    public function index()
    {
        $tourModel = ActivityTour::orderBy('id', 'DESC');
        if (request()->country)
            $tourModel->where('activity_country_id', request()->country);

        $tours = $tourModel->get();
        return view('backend.activity.tour.index')->with(['tours' => $tours]);
    }

    public function create()
    {
        if (request()->country) {
            $country = ActivityCountry::findOrFail(request()->country);
            $categories = ActivityCategory::orderBy('id', 'DESC')->get();
            $cities = ActivityCity::where('activity_country_id', request()->country)->orderBy('id', 'DESC')->get();
            $types = ActivityType::orderBy('id', 'DESC')->get();
            return view('backend.activity.tour.create')->with(['cities' => $cities,
                'categories' => $categories,
                'country_tour' => $country,
                'types' => $types
            ]);
        } else {
            return redirect()->route('admin.activitytours.index');
        }
    }

    public function store(Request $request)
    {

        $dataIn = $request->all();

        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['date'] = date("Y-m-d", strtotime($dataIn['date']));
        $dataIn['cancellation_date'] = date("Y-m-d", strtotime($dataIn['cancellation_date']));


        $dataUp = [];

        try {
            DB::beginTransaction();
            $tour = ActivityTour::create($dataIn);

            if ($request->has('image_en') != null) {
                $imageName = time() . '.activitytourimageen' . $tour->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataUp['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                $imageName = time() . '.activitytourimagear' . $tour->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataUp['image_ar'] = $imageName;
            }
            $tour->update($dataUp);

            if (isset($request->types)) {
                $types = $request->types;
                foreach ($types as $type) {
                    $dataType['activity_type_id'] = $type;
                    $dataType['activity_tour_id'] = $tour->id;
                    ActivityTourType::create($dataType);
                }
            }
            if (isset($request->category)) {
                $categories = $request->category;
                $dataCategory['activity_tour_id'] = $tour->id;
                foreach ($categories['category_id'] as $key3 => $category) {
                    $dataCategory['activity_category_id'] = $categories['category_id'][$key3];
                    $dataCategory['type'] = $categories['type'][$key3];
                    $dataCategory['adult_price'] = $categories['adult_price'][$key3];
                    $dataCategory['infant_price'] = $categories['infant_price'][$key3];
                    $dataCategory['child_3_5_price'] = $categories['child_3_5_price'][$key3];
                    $dataCategory['child_6_11_price'] = $categories['child_6_11_price'][$key3];
                    $dataCategory['person_1_4_price'] = $categories['person_1_4_price'][$key3];
                    $dataCategory['person_1_8_price'] = $categories['person_1_8_price'][$key3];
                    $dataCategory['person_1_12_price'] = $categories['person_1_12_price'][$key3];
                    $dataCategory['shared_note_ar'] = $categories['shared_note_ar'][$key3];
                    $dataCategory['shared_note_en'] = $categories['shared_note_en'][$key3];
                    $dataCategory['private_note_ar'] = $categories['private_note_ar'][$key3];
                    $dataCategory['private_note_en'] = $categories['private_note_en'][$key3];
                    if (isset($categories['private_is_shared'][$key3]) && $categories['private_is_shared'][$key3])
                        $dataCategory['private_is_shared'] = 1;
                    else
                        $dataCategory['private_is_shared'] = 0;
                    ActivityTourCategory::create($dataCategory);
                }
            }
            if (isset($request->inclusions)) {
                $inclusions = $request->inclusions;
                $dataInclusion['activity_tour_id'] = $tour->id;
                foreach ($inclusions['inclusions'] as $key => $value) {
                    $dataInclusion['value_en'] = isset($inclusions['value_en'][$key]) ? $inclusions['value_en'][$key] : "";
                    $dataInclusion['value_ar'] = isset($inclusions['value_ar'][$key]) ? $inclusions['value_ar'][$key] : "";
                    ActivityInclusion::create($dataInclusion);
                }
            }
            if (isset($request->exclusions)) {
                $exclusions = $request->exclusions;
                $dataExclusion['activity_tour_id'] = $tour->id;
                foreach ($exclusions['exclusions'] as $key1 => $value) {
                    $dataExclusion['value_en'] = isset($exclusions['value_en'][$key1]) ? $exclusions['value_en'][$key1] : "";
                    $dataExclusion['value_ar'] = isset($exclusions['value_ar'][$key1]) ? $exclusions['value_ar'][$key1] : "";
                    ActivityExclusion::create($dataExclusion);
                }

            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return redirect()->route('admin.activitytours.index', ['country' => $tour->activity_country_id]);
    }

    public function edit($id)
    {
        $tour = ActivityTour::findOrFail($id);
        $countries = ActivityCountry::orderBy('id', 'DESC')->get();
        $categories = ActivityCategory::orderBy('id', 'DESC')->get();
        $cities = ActivityCity::where('activity_country_id', $tour->activity_country_id)->orderBy('id', 'DESC')->get();
        $types = ActivityType::orderBy('id', 'DESC')->get();
        return view('backend.activity.tour.edit', compact('tour', 'countries', 'categories', 'cities', 'types'));

    }

    public function update(Request $request, $id)
    {
        $dataIn = $request->all();

        $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataIn['date'] = date("Y-m-d", strtotime($dataIn['date']));
        $dataIn['cancellation_date'] = date("Y-m-d", strtotime($dataIn['cancellation_date']));

        $tour = ActivityTour::findOrFail($id);

        try {

            if ($request->has('image_en') != null) {
                $imageName = time() . '.activitytourimageen' . $tour->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataIn['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                $imageName = time() . '.activitytourimagear' . $tour->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataIn['image_ar'] = $imageName;
            }
            DB::beginTransaction();
            $tour->update($dataIn);
            if (isset($request->types)) {
                $types = $request->types;
                ActivityTourType::where('activity_tour_id', $id)->delete();
                foreach ($types as $type) {
                    $dataType['activity_type_id'] = $type;
                    $dataType['activity_tour_id'] = $tour->id;
                    ActivityTourType::create($dataType);
                }
            }

            if (isset($request->category)) {
//                ActivityTourCategory::where('activity_tour_id', $id)->delete();
                $categories = $request->category;
//                $dataCategory['activity_tour_id'] = $tour->id;
                $categories_ids = $request->categoryIds;
                foreach ($categories_ids as $id) {
                    $ActivityTourCategory = ActivityTourCategory::find($id);
//                    $dataCategory['activity_category_id'] = $categories['category_id'][$key3];
                    $dataCategory['type'] = $categories['type'][$id];
                    $dataCategory['adult_price'] = $categories['adult_price'][$id];
                    $dataCategory['infant_price'] = $categories['infant_price'][$id];
                    $dataCategory['child_3_5_price'] = $categories['child_3_5_price'][$id];
                    $dataCategory['child_6_11_price'] = $categories['child_6_11_price'][$id];
                    $dataCategory['person_1_4_price'] = $categories['person_1_4_price'][$id];
                    $dataCategory['person_1_8_price'] = $categories['person_1_8_price'][$id];
                    $dataCategory['person_1_12_price'] = $categories['person_1_12_price'][$id];
                    $dataCategory['shared_note_ar'] = $categories['shared_note_ar'][$id];
                    $dataCategory['shared_note_en'] = $categories['shared_note_en'][$id];
                    $dataCategory['private_note_ar'] = $categories['private_note_ar'][$id];
                    $dataCategory['private_note_en'] = $categories['private_note_en'][$id];
                    if (isset($categories['private_is_shared'][$id]) && $categories['private_is_shared'][$id])
                        $dataCategory['private_is_shared'] = 1;
                    else
                        $dataCategory['private_is_shared'] = 0;
//                    ActivityTourCategory::create($dataCategory);
                    $ActivityTourCategory->update($dataCategory);
                }
            }
            if (isset($request->inclusions)) {
                $inclusions = $request->inclusions;
                $dataInclusion['activity_tour_id'] = $tour->id;
                ActivityInclusion::where('activity_tour_id', $id)->delete();
                foreach ($inclusions['inclusions'] as $key => $value) {
                    $dataInclusion['value_en'] = isset($inclusions['value_en'][$key]) ? $inclusions['value_en'][$key] : "";
                    $dataInclusion['value_ar'] = isset($inclusions['value_ar'][$key]) ? $inclusions['value_ar'][$key] : "";
                    ActivityInclusion::create($dataInclusion);
                }
            }
            if (isset($request->exclusions)) {
                $exclusions = $request->exclusions;
                $dataExclusion['activity_tour_id'] = $tour->id;
                ActivityExclusion::where('activity_tour_id', $id)->delete();
                foreach ($exclusions['exclusions'] as $key1 => $value) {
                    $dataExclusion['value_en'] = isset($exclusions['value_en'][$key1]) ? $exclusions['value_en'][$key1] : "";
                    $dataExclusion['value_ar'] = isset($exclusions['value_ar'][$key1]) ? $exclusions['value_ar'][$key1] : "";
                    ActivityExclusion::create($dataExclusion);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('admin.activitytours.index', ['country' => $tour->activity_country_id]);
    }

    public function destroy($id)
    {
        $tour = ActivityTour::findOrFail($id);
        $tour->delete();
        return redirect()->route('admin.activitytours.index', ['country' => $tour->activity_country_id]);
    }

    public function showInfoForm()
    {
        $info = GeneralInformation::where('type', 'activity')->firstOrFail();
        $activity_checkout = GlobalModel::findOrFail('activity-checkout');
        return view('backend.activity.tour.info', compact('info' ,'activity_checkout'));
    }

    public function saveInfo(Request $request)
    {
        $info = GeneralInformation::where('type', 'activity')->firstOrFail();

        $dataUp = $request->all();
        if ($request->has('header_image_en') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_en))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_en));
            }
            $imageName = time() . '.activityinfoheaderimageen' . $info->id . '.' . $request->header_image_en->getClientOriginalExtension();
            $request->header_image_en->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_en'] = $imageName;
        }

        if ($request->has('header_image_ar') != null) {
            if (File::exists(storage_path($this->imagePathInfo . $info->header_image_ar))) {
                File::delete(storage_path($this->imagePathInfo . $info->header_image_ar));
            }
            $imageName = time() . '.activityinfoheaderimagear' . $info->id . '.' . $request->header_image_ar->getClientOriginalExtension();
            $request->header_image_ar->storeAs($this->imagePathInfo, $imageName);
            $dataUp['header_image_ar'] = $imageName;
        }
        $info->update($dataUp);
        
        $activity_checkout = GlobalModel::findOrFail('activity-checkout');
        if(isset($request->activity_checkout))
            $activity_checkout->status = 1;
        else
            $activity_checkout->status = 0;
        $activity_checkout->save();

        return redirect()->route('admin.activity.info');
    }
}
