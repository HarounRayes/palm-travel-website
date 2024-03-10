<?php

namespace App\Http\Controllers\Backend;

use App\ActivityCategory;
use App\ActivityCity;
use App\ActivityTour;
use App\City;
use App\Country;
use App\Enquiry;
use App\GlobalModel;
use App\Hotel;
use App\Http\Controllers\Controller;
use App\Package;
use App\Tour;
use App\VisaCountry;
use App\VisaCountryNationality;
use App\VisaType;
use App\VisaUaeNationality;
use App\VisaUaeRequirement;
use App\VisaUaeType;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getCityOfCountry(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        return response()->json(['data' => view('backend.ajax.cityofcountry', ['cities' => $cities])->render()], 200);
    }

    public function gethotelOfCountry(Request $request)
    {
        $hotels = Hotel::where('country_id', $request->country_id)->get();
        return response()->json(['data' => view('backend.ajax.hotelofcountry', ['hotels' => $hotels])->render()], 200);
    }

    public function addinclusion(Request $request)
    {
        $count_inclusion = $request->count_inclusion;
        return response()->json(['data' => view('backend.ajax.inclusion', ['count_inclusion' => $count_inclusion])->render()], 200);
    }

    public function addexclusion(Request $request)
    {
        $count_exclusion = $request->count_exclusion;
        return response()->json(['data' => view('backend.ajax.exclusion', ['count_exclusion' => $count_exclusion])->render()], 200);
    }

    public function addlabel(Request $request)
    {
        $count_label = $request->count_label;
        return response()->json(['data' => view('backend.ajax.label', ['count_label' => $count_label])->render()], 200);
    }

    public function addday(Request $request)
    {
        $count_day = $request->count_day;
        return response()->json(['data' => view('backend.ajax.day', ['count_day' => $count_day])->render()], 200);
    }

    public function addtourtoday(Request $request)
    {
        $day = $request->day;
        $count_day_tour = $request->count_day_tour;
        $country = $request->country;
        $cities = City::where('country_id', $country)->get();
        return response()->json(['data' => view('backend.ajax.daytour', ['count_day_tour' => $count_day_tour, 'day' => $day, 'country' => $country, 'cities' => $cities])->render()], 200);
    }

    public function gettourofcity(Request $request)
    {
        if (isset($request->city_id)) {
            $tours = Tour::where('city_id', $request->city_id)->get();
            $count_tour = $request->count_tour;
            $day = $request->day;
            return response()->json(['data' => view('backend.ajax.tourofcity', ['tours' => $tours, 'count_tour' => $count_tour, 'day' => $day])->render()], 200);
        } else {
            return response()->json(['data' => "Please select city"], 200);
        }
    }

    public function addtransfer(Request $request)
    {
        $count_transfer = $request->count_transfer;
        return response()->json(['data' => view('backend.ajax.transfer', ['count_transfer' => $count_transfer])->render()], 200);
    }

    public function addflight(Request $request)
    {
        $count_flight = $request->count_flight;
        return response()->json(['data' => view('backend.ajax.flight', ['count_flight' => $count_flight])->render()], 200);
    }

    public function addsegmenttoflight(Request $request)
    {
        $flight = $request->flight;
        $count_flight_segment = $request->count_flight_segment;
        return response()->json(['data' => view('backend.ajax.segmentofflight', ['flight' => $flight, 'count_flight_segment' => $count_flight_segment])->render()], 200);

    }

    public function addhotel(Request $request)
    {
        $count_hotel = $request->count_hotel;
        $country_id = $request->country_id;
        $hotel = Hotel::findOrFail($request->hotel_id);
        $all_hotels = Hotel::where('country_id', $country_id)->get();

        return response()->json(['data' => view('backend.ajax.hotel', ['all_hotels' => $all_hotels, 'count_hotel' => $count_hotel, 'hotel' => $hotel, 'country_id' => $country_id])->render()], 200);
    }

    public function addsegmenttofhotel(Request $request)
    {
        $count_hotel = $request->count_hotel;
        $hotel_segment = Hotel::findOrFail($request->hotel_id);
        $count_hotel_segment = $request->count_hotel_segment;
        return response()->json(['data' => view('backend.ajax.segmentofhotel', ['count_hotel' => $count_hotel, 'hotel_segment' => $hotel_segment, 'count_hotel_segment' => $count_hotel_segment])->render()], 200);

    }

    public function addpricingofhotel(Request $request)
    {
        $count_hotel = $request->count_hotel;
        return response()->json(['data' => view('backend.ajax.pricingofhotel', ['count_hotel' => $count_hotel])->render()], 200);

    }

    public function addtypetohome(Request $request)
    {
        $id = $request->id;
        $type = VisaType::findOrFail($id);
        $type->update(['add_to_home' => $request->home]);
    }

    public function addActivityTourToHome(Request $request)
    {
        $id = $request->id;
        $tour = ActivityTour::findOrFail($id);
        $tour->update(['add_to_home' => $request->home]);
    }

    public function addcountrytohome(Request $request)
    {
        $id = $request->id;
        $country = VisaCountry::findOrFail($id);
        $country->update(['add_to_home' => $request->home]);
    }

    public function addMainCountryToHome(Request $request)
    {
        $id = $request->id;
        $country = Country::findOrFail($id);
        $country->update(['add_to_home' => $request->home]);
    }

    public function getNationalitiesOfCountry(Request $request)
    {
        $nationalities = VisaCountryNationality::where('visa_country_id', $request->country)->get();
        return response()->json(['data' => view('backend.ajax.nationalityofcpuntry', ['nationalities' => $nationalities])->render()], 200);
    }

    public function getActivityCityOfCountry(Request $request)
    {
        $cities = ActivityCity::where('activity_country_id', $request->country_id)->get();
        return response()->json(['data' => view('backend.ajax.activitycityofcountry', ['cities' => $cities])->render()], 200);
    }

    public function addTourCategory(Request $request)
    {
        $count_category = $request->count_category;
        $category = ActivityCategory::findOrFail($request->category_id);

        return response()->json(['data' => view('backend.ajax.category', ['count_category' => $count_category, 'category' => $category])->render()], 200);
    }

    public function updateGlobalStatus(Request $request)
    {
        $model = GlobalModel::findOrFail($request->name);
        $model->update(['status' => $request->status]);

    }

    public function updatePackageStatus(Request $request)
    {
        $package = Package::findOrFail($request->id);
        if ($request->status == 1) {
            $package->update(['status' => '1']);
        } else {
            var_dump($package->update(['status' => '0']));
        }
    }
    public function updatePackageFeatured(Request $request)
    {
        $package = Package::findOrFail($request->id);
        if ($request->status == 1) {
            $package->is_featured =1 ;
        } else {
            $package->is_featured = 0 ;
        }
        return $package->save();
    }
    public function acceptedEnquiry(Request $request)
    {
        $enquiry = Enquiry::findOrFail($request->id);
        if ($request->accepted == 1) {
            $enquiry->update(['accepted' => '1']);
        } else {
            var_dump($enquiry->update(['accepted' => '0']));
        }
    }

    public function nationalityType(Request $request)
    {
        $count_type = $request->count_type;
        $type_id = $request->type_id;
        $type = VisaUaeType::findOrFail($request->type_id);
        $requirements = VisaUaeRequirement::document()->get();
        return response()->json(['data' => view('backend.ajax.nationalityType', ['count_type' => $count_type, 'type' => $type, 'type_id' => $type_id, 'requirements' => $requirements])->render()], 200);
    }

    public function addVisaNationalityToHome(Request $request)
    {

        $nationality = VisaUaeNationality::findOrFail($request->id);
        $nationality->update(['add_to_home' => $request->home]);
    }

    public function addVisaTypeToHome(Request $request)
    {
        $type = VisaUaeType::findOrFail($request->id);
        $type->update(['add_to_home' => $request->home]);
    }
}

