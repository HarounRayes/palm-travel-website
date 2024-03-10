<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Day;
use App\Exclusion;
use App\Flight;
use App\FlightSegment;
use App\Hotel;
use App\Http\Controllers\Controller;
use App\Inclusion;
use App\Label;
use App\Offer;
use App\Package;
use App\PackageDayTour;
use App\PackageHotel;
use App\PackageHotelPricing;
use App\PackageHotelPricingDetail;
use App\PackageHotelSegment;
use App\PackageOffer;
use App\PackageType;
use App\Tour;
use App\Transfer;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    private $imagePath = "public/images/package/";
    private $pdfPath = "public/pdf/";

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:packages.create.en|packages.create.ar')->only(['create', 'store']);
        $this->middleware('permission:packages.edit.en|packages.edit.ar')->only(['edit', 'update']);
        $this->middleware('permission:packages.order')->only(['showOrderForm', 'saveOrder']);
        $this->middleware('permission:packages.delete')->only('destroy');
        $this->middleware('permission:packages.slider')->only(['index']);
    }

    public function index(Request $request)
    {
        if (request()->country) {
            $country = Country::findOrFail(request()->country);
            $packages = Package::where('country', request()->country)->orderBy('id', 'DESC')->get();
            return view('backend.package.index')->with(['packages' => $packages, 'country' => $country]);
        } else {
            $countries = Country::orderBy('id', 'DESC')->paginate(20);
            return view('backend.package.countries')->with(['countries' => $countries]);
        }
    }

    public function create()
    {
        $countries = Country::orderBy('id', 'DESC')->get();
        $types = Type::orderBy('id', 'DESC')->get();
        $offers = Offer::orderBy('id', 'DESC')->get();
        return view('backend.package.create')->with(['countries' => $countries, 'types' => $types, 'offers' => $offers]);
    }

    public function store(Request $request)
    {
        $dataIn = $request->all();
        $validator = Validator::make($dataIn, [
            'publish' => 'required',
            'publish_date' => 'required|date',
            'suppress_date' => 'required|date',
            'date' => 'nullable|date',
            'country' => 'required',
            'city' => 'required',
            'flight' => 'in:0,1',
            'hotels' => 'in:0,1',
            'transfer' => 'in:0,1',
            'activity' => 'in:0,1',
            'open_include' => 'in:0,1',
            'open_not_include' => 'in:0,1',
            'open_term' => 'in:0,1',
            'open_cancellation' => 'in:0,1',
            'open_additional_info' => 'nullable|integer',
            'number' => 'integer',
            'package_order' => 'integer',
        ])->validate();

        if ($request->input('action') == "Draft") {
            $dataIn['draft'] = '1';
        }
        $dataIn['created_by'] = $dataIn['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();

        $dataIn['publish_date'] = Carbon::createFromTimestamp(strtotime($dataIn['publish_date']))->format('Y-m-d');
        $dataIn['suppress_date'] = Carbon::createFromTimestamp(strtotime($dataIn['suppress_date']))->format('Y-m-d');

        $dataIn['date'] = Carbon::createFromTimestamp(strtotime($dataIn['date']))->format('Y-m-d');

        try {
            DB::beginTransaction();
            $package = Package::create($dataIn);

            $dataUp = [];
            if ($request->has('map') != null) {
                $imageName = time() . '.packagemap' . $request->map->getClientOriginalExtension();
                $request->map->storeAs($this->imagePath, $imageName);
                $dataUp['map'] = $imageName;
            }

            if ($request->has('image_en') != null) {
                $imageName = time() . '.packageimageen' . $package->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataUp['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                $imageName = time() . '.packageimagear' . $package->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataUp['image_ar'] = $imageName;
            }

            if ($request->has('package_image_header_en') != null) {
                $imageName = time() . '.packageimageheaderen' . $package->id . '.' . $request->package_image_header_en->getClientOriginalExtension();
                $request->package_image_header_en->storeAs($this->imagePath, $imageName);
                $dataUp['package_image_header_en'] = $imageName;
            }

            if ($request->has('package_image_header_ar') != null) {
                $imageName = time() . '.packageimageheaderar' . $package->id . '.' . $request->package_image_header_ar->getClientOriginalExtension();
                $request->package_image_header_ar->storeAs($this->imagePath, $imageName);
                $dataUp['package_image_header_ar'] = $imageName;
            }

            if ($request->has('pdf_en') != null) {
                $imageName = time() . '.packagepdfen' . $package->id . '.' . $request->pdf_en->getClientOriginalExtension();
                $request->pdf_en->storeAs($this->pdfPath, $imageName);
                $dataUp['pdf_en'] = $imageName;
            }
            if ($request->has('pdf_ar') != null) {
                $imageName = time() . '.packagepdfar' . $package->id . '.' . $request->pdf_ar->getClientOriginalExtension();
                $request->pdf_ar->storeAs($this->pdfPath, $imageName);
                $dataUp['pdf_ar'] = $imageName;
            }

            $package->update($dataUp);
            if (isset($request->types)) {
                $types = $request->types;
                foreach ($types as $type) {
                    $dataType['type_id'] = $type;
                    $dataType['package_id'] = $package->id;
                    PackageType::create($dataType);
                }
            }
            if (isset($request->offers)) {
                $offers = $request->offers;
                foreach ($offers as $offer) {
                    $dataOffer['offer_id'] = $offer;
                    $dataOffer['package_id'] = $package->id;
                    PackageOffer::create($dataOffer);
                }
            }

            if (isset($request->inclusions)) {
                $inclusions = $request->inclusions;
                $dataInclusion['package_id'] = $package->id;
                foreach ($inclusions['inclusions'] as $key => $value) {
                    $dataInclusion['value_en'] = isset($inclusions['value_en'][$key]) ? $inclusions['value_en'][$key] : "";
                    $dataInclusion['value_ar'] = isset($inclusions['value_ar'][$key]) ? $inclusions['value_ar'][$key] : "";
                    Inclusion::create($dataInclusion);
                }
            }
            if (isset($request->exclusions)) {
                $exclusions = $request->exclusions;
                $dataExclusion['package_id'] = $package->id;
                foreach ($exclusions['exclusions'] as $key1 => $value) {
                    $dataExclusion['value_en'] = isset($exclusions['value_en'][$key1]) ? $exclusions['value_en'][$key1] : "";
                    $dataExclusion['value_ar'] = isset($exclusions['value_ar'][$key1]) ? $exclusions['value_ar'][$key1] : "";
                    Exclusion::create($dataExclusion);
                }

            }
            if (isset($request->labels)) {
                $labels = $request->labels;
                $dataLabel['package_id'] = $package->id;
                foreach ($labels['labels'] as $key3 => $value) {
                    $dataLabel['value_en'] = isset($labels['value_en'][$key3]) ? $labels['value_en'][$key3] : "";
                    $dataLabel['value_ar'] = isset($labels['value_ar'][$key3]) ? $labels['value_ar'][$key3] : "";
                    $dataLabel['color_en'] = isset($labels['color_en'][$key3]) ? $labels['color_en'][$key3] : "";
                    $dataLabel['color_ar'] = isset($labels['color_ar'][$key3]) ? $labels['color_ar'][$key3] : "";
                    Label::create($dataLabel);
                }
            }
            if (isset($request->transfers)) {
                $transfers = $request->transfers;
                $dataTransfer['package_id'] = $package->id;
                foreach ($transfers['transfers'] as $key4 => $value) {
                    if (isset($transfers['date'][$key4]))
                        $dataTransfer['date'] = Carbon::createFromTimestamp(strtotime($transfers['date'][$key4]))->format('Y-m-d');

                    $dataTransfer['time'] = isset($transfers['time'][$key4]) ? $transfers['time'][$key4] : "";

                    $dataTransfer['image'] = isset($transfers['image'][$key4]) ? $transfers['image'][$key4] : "";

                    $dataTransfer['type_en'] = isset($transfers['type_en'][$key4]) ? $transfers['type_en'][$key4] : "";
                    $dataTransfer['type_ar'] = isset($transfers['type_ar'][$key4]) ? $transfers['type_ar'][$key4] : "";
                    $dataTransfer['pickup_location_en'] = isset($transfers['pickup_location_en'][$key4]) ? $transfers['pickup_location_en'][$key4] : "";
                    $dataTransfer['pickup_location_ar'] = isset($transfers['pickup_location_ar'][$key4]) ? $transfers['pickup_location_ar'][$key4] : "";
                    $dataTransfer['drop_off_location_en'] = isset($transfers['drop_off_location_en'][$key4]) ? $transfers['drop_off_location_en'][$key4] : "";
                    $dataTransfer['drop_off_location_ar'] = isset($transfers['drop_off_location_ar'][$key4]) ? $transfers['drop_off_location_ar'][$key4] : "";

                    Transfer::create($dataTransfer);
                }
            }
            if (isset($request->days)) {
                $days = $request->days;
                foreach ($days['days'] as $key2 => $value) {
                    $dataDay['day_title_en'] = isset($days['title_en'][$key2]) ? $days['title_en'][$key2] : "";
                    $dataDay['day_title_ar'] = isset($days['title_ar'][$key2]) ? $days['title_ar'][$key2] : "";
                    $dataDay['day_description_ar'] = isset($days['description_ar'][$key2]) ? $days['description_ar'][$key2] : "";
                    $dataDay['day_description_en'] = isset($days['description_en'][$key2]) ? $days['description_en'][$key2] : "";
                    if (isset($days['open_day'][$key2])) {
                        $dataDay['open_day'] = $days['open_day'][$key2];
                    }
                    $dataDay['package_id'] = $package->id;
                    $dayModel = Day::create($dataDay);
                    if (isset($days['tours'][$key2])) {
                        $tours = $days['tours'][$key2];
                        $dataTour['package_id'] = $package->id;
                        $dataTour['day_id'] = $dayModel->id;
                        foreach ($tours as $tour) {
                            $dataTour['tour_id'] = $tour;
                            PackageDayTour::create($dataTour);
                        }
                    }
                }
            }
            if (isset($request->flights)) {
                $flights = $request->flights;
                $dataFlight['package_id'] = $package->id;

                foreach ($flights['flights'] as $key5 => $flight) {
                    $dataFlight['departure_from_en'] = isset($flights['departure_from_en'][$key5]) ? $flights['departure_from_en'][$key5] : "";
                    $dataFlight['departure_from_ar'] = isset($flights['departure_from_ar'][$key5]) ? $flights['departure_from_ar'][$key5] : "";
                    $dataFlight['departure_to_en'] = isset($flights['departure_to_en'][$key5]) ? $flights['departure_to_en'][$key5] : "";
                    $dataFlight['departure_to_ar'] = isset($flights['departure_to_ar'][$key5]) ? $flights['departure_to_ar'][$key5] : "";

                    $flightModel = Flight::create($dataFlight);
                    if (isset($flights['segments'][$key5])) {
                        $segments = $flights['segments'][$key5];
                        $dataSegment['package_id'] = $package->id;
                        $dataSegment['flight_id'] = $flightModel->id;

                        foreach ($segments['segments'] as $key7 => $value) {

                            if (isset($segments['departure_date'][$key7]))
                                $dataSegment['departure_date'] = Carbon::createFromTimestamp(strtotime($segments['departure_date'][$key7]))->format('Y-m-d');
                            $dataSegment['departure_time'] = isset($segments['departure_time'][$key7]) ? $segments['departure_time'][$key7] : null;
                            if (isset($segments['arrival_date'][$key7]))
                                $dataSegment['arrival_date'] = Carbon::createFromTimestamp(strtotime($segments['arrival_date'][$key7]))->format('Y-m-d');
                            $dataSegment['arrival_time'] = isset($segments['arrival_time'][$key7]) ? $segments['arrival_time'][$key7] : null;
                            $dataSegment['flight_number'] = isset($segments['flight_number'][$key7]) ? $segments['flight_number'][$key7] : "";
                            $dataSegment['departure_from_en'] = isset($segments['departure_from_en'][$key7]) ? $segments['departure_from_en'][$key7] : "";
                            $dataSegment['departure_from_ar'] = isset($segments['departure_from_ar'][$key7]) ? $segments['departure_from_ar'][$key7] : "";
                            $dataSegment['arrival_to_en'] = isset($segments['arrival_to_en'][$key7]) ? $segments['arrival_to_en'][$key7] : "";
                            $dataSegment['arrival_to_ar'] = isset($segments['arrival_to_ar'][$key7]) ? $segments['arrival_to_ar'][$key7] : "";
                            $dataSegment['flight_en'] = isset($segments['flight_en'][$key7]) ? $segments['flight_en'][$key7] : "";
                            $dataSegment['flight_ar'] = isset($segments['flight_ar'][$key7]) ? $segments['flight_ar'][$key7] : "";
                            if ($request->has('flights.segments.' . $key5 . '.icon.' . $key7) != null) {
                                $icon = $segments['icon'][$key7];
                                $imageName = time() . '.flighticon' . $icon->getClientOriginalExtension();
                                $icon->storeAs($this->imagePath, $imageName);
                                $dataSegment['icon'] = $imageName;
                            }
                            FlightSegment::create($dataSegment);
                            unset($dataSegment);

                        }
                        unset($segments);
                    }
                }
            }
            if (isset($request->hotel)) {

                $all_hotels = $request->hotel;
                $dataHotel['package_id'] = $package->id;

                foreach ($all_hotels['hotel_id'] as $i => $hotel_id) {

                    $dataHotel['hotel_id'] = $hotel_id;
                    $dataHotel['price'] = $all_hotels['price'][$i];

                    if (isset($all_hotels['check_in'][$i]))
                        $dataHotel['check_in'] = Carbon::createFromTimestamp(strtotime($all_hotels['check_in'][$i]))->format('Y-m-d');
                    else
                        $dataHotel['check_in'] = null;

                    if (isset($all_hotels['check_out'][$i]))
                        $dataHotel['check_out'] = Carbon::createFromTimestamp(strtotime($all_hotels['check_out'][$i]))->format('Y-m-d');
                    else
                        $dataHotel['check_out'] = null;

                    if (isset($all_hotels['bookable'][$i]))
                        $dataHotel['bookable'] = $all_hotels['bookable'][$i];
                    else
                        $dataHotel['bookable'] = '0';

                    if (isset($all_hotels['sold_out'][$i]))
                        $dataHotel['sold_out'] = $all_hotels['sold_out'][$i];
                    else
                        $dataHotel['sold_out'] = '0';

                    if (isset($all_hotels['enquiry'][$i]))
                        $dataHotel['enquiry'] = $all_hotels['enquiry'][$i];
                    else
                        $dataHotel['enquiry'] = '0';

                    $PackageHotel = PackageHotel::create($dataHotel);
                    if (isset($all_hotels['packagehotelpricing'])) {
                        $packagehotelpricing = $all_hotels['packagehotelpricing'];

                        $dataPricing['package_id'] = $package->id;
                        $dataPricing['hotel_id'] = $hotel_id;
                        $dataPricing['package_hotel_id'] = $PackageHotel->id;
                        $dataPricing['adult_1'] = $packagehotelpricing['adult_1'][$i];
                        $dataPricing['adult_2'] = $packagehotelpricing['adult_2'][$i];
                        $dataPricing['adult_3'] = $packagehotelpricing['adult_3'][$i];
                        $dataPricing['child_0_2_1'] = $packagehotelpricing['child_0_2_1'][$i];
                        $dataPricing['child_0_2_2'] = $packagehotelpricing['child_0_2_2'][$i];
                        $dataPricing['child_0_2_3'] = $packagehotelpricing['child_0_2_3'][$i];
                        $dataPricing['child_3_5_1'] = $packagehotelpricing['child_3_5_1'][$i];
                        $dataPricing['child_3_5_2'] = $packagehotelpricing['child_3_5_2'][$i];
                        $dataPricing['child_3_5_3'] = $packagehotelpricing['child_3_5_3'][$i];
                        $dataPricing['child_6_11_1'] = $packagehotelpricing['child_6_11_1'][$i];
                        $dataPricing['child_6_11_2'] = $packagehotelpricing['child_6_11_2'][$i];
                        $dataPricing['child_6_11_3'] = $packagehotelpricing['child_6_11_3'][$i];

                        PackageHotelPricing::create($dataPricing);
                    }
                    if (isset($all_hotels['pricing'][$i]['pricing'])) {
                        $dataPricingDetail['package_id'] = $package->id;
                        $dataPricingDetail['hotel_id'] = $hotel_id;
                        $dataPricingDetail['package_hotel_id'] = $PackageHotel->id;

                        foreach ($all_hotels['pricing'][$i]['pricing'] as $key5 => $value) {

                            $dataPricingDetail['cost_en'] = isset($all_hotels['pricing'][$i]['cost_en'][$key5]) ? $all_hotels['pricing'][$i]['cost_en'][$key5] : "";
                            $dataPricingDetail['cost_ar'] = isset($all_hotels['pricing'][$i]['cost_ar'][$key5]) ? $all_hotels['pricing'][$i]['cost_ar'][$key5] : "";
                            $dataPricingDetail['value_ar'] = isset($all_hotels['pricing'][$i]['value_ar'][$key5]) ? $all_hotels['pricing'][$i]['value_ar'][$key5] : "";
                            $dataPricingDetail['value_en'] = isset($all_hotels['pricing'][$i]['value_en'][$key5]) ? $all_hotels['pricing'][$i]['value_en'][$key5] : "";
                            PackageHotelPricingDetail::create($dataPricingDetail);
                        }
                    }

                    if (isset($all_hotels['segments'][$i]['segments'])) {
                        $dataHotelSegment['package_id'] = $package->id;
                        $dataHotelSegment['main_hotel_id'] = $hotel_id;
                        $dataHotelSegment['package_hotel_id'] = $PackageHotel->id;

                        foreach ($all_hotels['segments'][$i]['segments'] as $key6 => $value) {
                            $dataHotelSegment['hotel_id'] = $all_hotels['segments'][$i]['hotel_id'][$key6];
                            if (isset($all_hotels['segments'][$i]['check_in'][$key6]))
                                $dataHotelSegment['check_in'] = Carbon::createFromTimestamp(strtotime($all_hotels['segments'][$i]['check_in'][$key6]))->format('Y-m-d');
                            if (isset($all_hotels['segments'][$i]['check_out'][$key6]))
                                $dataHotelSegment['check_out'] = Carbon::createFromTimestamp(strtotime($all_hotels['segments'][$i]['check_out'][$key6]))->format('Y-m-d');

                            PackageHotelSegment::create($dataHotelSegment);

                        }
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('admin.packages.index', ['country' => $package->country_id]);
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $countries = Country::orderBy('id', 'DESC')->get();
        $cities = City::where('country_id', $package->country)->orderBy('id', 'DESC')->get();
        $tours = Tour::where('city_id', $package->city)->orderBy('id', 'DESC')->get();
        $types = Type::orderBy('id', 'DESC')->get();
        $offers = Offer::orderBy('id', 'DESC')->get();
        $transfer_image_array = ['car', 'bus', 'boat', 'train','airplane'];
        $all_hotels = Hotel::where('country_id', $package->country)->get();
        return view('backend.package.edit')->with(['countries' => $countries, 'types' => $types, 'offers' => $offers, 'package' => $package, 'cities' => $cities, 'transfer_image_array' => $transfer_image_array, 'tours' => $tours, 'all_hotels' => $all_hotels]);
    }

    public function update(Request $request, $id)
    {
        $dataUp = $request->all();
        $validator = Validator::make($dataUp, [
            'publish' => 'required',
            'publish_date' => 'required|date',
            'suppress_date' => 'required|date',
            'date' => 'nullable|date',
            'country' => 'required',
            'city' => 'required',
            'flight' => 'in:0,1',
            'hotels' => 'in:0,1',
            'transfer' => 'in:0,1',
            'activity' => 'in:0,1',
            'open_include' => 'in:0,1',
            'open_not_include' => 'in:0,1',
            'open_term' => 'in:0,1',
            'open_cancellation' => 'in:0,1',
            'open_additional_info' => 'nullable|integer',
            'number' => 'integer',
            'package_order' => 'integer',
        ])->validate();

        if ($request->input('action') == "Draft") {
            $dataUp['draft'] = '1';
        } else {
            $dataUp['draft'] = '0';
        }

        $dataUp['updated_by'] = Auth::guard('admin')->user()->getAuthIdentifier();
        $dataUp['publish_date'] = Carbon::createFromTimestamp(strtotime($dataUp['publish_date']))->format('Y-m-d');
        $dataUp['suppress_date'] = Carbon::createFromTimestamp(strtotime($dataUp['suppress_date']))->format('Y-m-d');

        $dataUp['date'] = Carbon::createFromTimestamp(strtotime($dataUp['date']))->format('Y-m-d');


        $package = Package::findOrFail($id);
//        var_dump($dataUp);die();
        try {

            if (isset($dataUp['flight']))
                $dataUp['flight'] = '1';
            else
                $dataUp['flight'] = '0';

            if (isset($dataUp['hotels']))
                $dataUp['hotels'] = '1';
            else
                $dataUp['hotels'] = '0';

            if (isset($dataUp['transfer']))
                $dataUp['transfer'] = '1';
            else
                $dataUp['transfer'] = '0';

            if (isset($dataUp['activity']))
                $dataUp['activity'] = '1';
            else
                $dataUp['activity'] = '0';

            if ($request->has('map') != null) {
                $imageName = time() . '.packagemap' . $package->id . '.' . $request->map->getClientOriginalExtension();
                $request->map->storeAs($this->imagePath, $imageName);
                $dataUp['map'] = $imageName;
            }

            if ($request->has('image_en') != null) {
                $imageName = time() . '.packageimageen' . $package->id . '.' . $request->image_en->getClientOriginalExtension();
                $request->image_en->storeAs($this->imagePath, $imageName);
                $dataUp['image_en'] = $imageName;
            }

            if ($request->has('image_ar') != null) {
                $imageName = time() . '.packageimagear' . $package->id . '.' . $request->image_ar->getClientOriginalExtension();
                $request->image_ar->storeAs($this->imagePath, $imageName);
                $dataUp['image_ar'] = $imageName;
            }

            if ($request->has('package_image_header_en') != null) {
                $imageName = time() . '.packageimageheaderen' . $package->id . '.' . $request->package_image_header_en->getClientOriginalExtension();
                $request->package_image_header_en->storeAs($this->imagePath, $imageName);
                $dataUp['package_image_header_en'] = $imageName;
            }

            if ($request->has('package_image_header_ar') != null) {
                $imageName = time() . '.packageimageheaderar' . $package->id . '.' . $request->package_image_header_ar->getClientOriginalExtension();
                $request->package_image_header_ar->storeAs($this->imagePath, $imageName);
                $dataUp['package_image_header_ar'] = $imageName;
            }

            if ($request->has('pdf_en') != null) {
                $imageName = time() . '.packagepdfen' . $package->id . '.' . $request->pdf_en->getClientOriginalExtension();
                $request->pdf_en->storeAs($this->pdfPath, $imageName);
                $dataUp['pdf_en'] = $imageName;
            }
            if ($request->has('pdf_ar') != null) {
                $imageName = time() . '.packagepdfar' . $package->id . '.' . $request->pdf_ar->getClientOriginalExtension();
                $request->pdf_ar->storeAs($this->pdfPath, $imageName);
                $dataUp['pdf_ar'] = $imageName;
            }
            DB::beginTransaction();
            $package->update($dataUp);

            if (isset($request->types)) {
                PackageType::where('package_id', $id)->delete();
                $types = $request->types;
                $dataType['package_id'] = $id;

                foreach ($types as $type) {
                    $dataType['type_id'] = $type;
                    PackageType::create($dataType);
                }
            }
            if (isset($request->offers)) {
                PackageOffer::where('package_id', $id)->delete();
                $offers = $request->offers;
                $dataOffer['package_id'] = $id;

                foreach ($offers as $offer) {
                    $dataOffer['offer_id'] = $offer;
                    PackageOffer::create($dataOffer);
                }
            }
            if (isset($request->inclusions)) {
                Inclusion::where('package_id', $id)->delete();
                $inclusions = $request->inclusions;
                $dataInclusion['package_id'] = $id;

                foreach ($inclusions['inclusions'] as $key => $value) {
                    $dataInclusion['value_en'] = isset($inclusions['value_en'][$key]) ? $inclusions['value_en'][$key] : "";
                    $dataInclusion['value_ar'] = isset($inclusions['value_ar'][$key]) ? $inclusions['value_ar'][$key] : "";

                    Inclusion::create($dataInclusion);
                }
            }
            if (isset($request->exclusions)) {
                Exclusion::where('package_id', $id)->delete();
                $exclusions = $request->exclusions;
                $dataExclusion['package_id'] = $id;
                foreach ($exclusions['exclusions'] as $key1 => $value) {
                    $dataExclusion['value_en'] = isset($exclusions['value_en'][$key1]) ? $exclusions['value_en'][$key1] : "";
                    $dataExclusion['value_ar'] = isset($exclusions['value_ar'][$key1]) ? $exclusions['value_ar'][$key1] : "";

                    Exclusion::create($dataExclusion);
                }

            }
            if (isset($request->labels)) {
                Label::where('package_id', $id)->delete();
                $labels = $request->labels;
                $dataLabel['package_id'] = $id;
                foreach ($labels['labels'] as $key3 => $value) {
                    $dataLabel['value_en'] = isset($labels['value_en'][$key3]) ? $labels['value_en'][$key3] : "";
                    $dataLabel['value_ar'] = isset($labels['value_ar'][$key3]) ? $labels['value_ar'][$key3] : "";
                    $dataLabel['color_en'] = isset($labels['color_en'][$key3]) ? $labels['color_en'][$key3] : "";
                    $dataLabel['color_ar'] = isset($labels['color_ar'][$key3]) ? $labels['color_ar'][$key3] : "";
                    Label::create($dataLabel);
                }
            }
            if (isset($request->transfers)) {
                Transfer::where('package_id', $id)->delete();
                $transfers = $request->transfers;
                $dataTransfer['package_id'] = $id;
                foreach ($transfers['transfers'] as $key4 => $value) {
                    if (isset($transfers['date'][$key4]))
                        $dataTransfer['date'] = Carbon::createFromTimestamp(strtotime($transfers['date'][$key4]))->format('Y-m-d');

                    $dataTransfer['time'] = isset($transfers['time'][$key4]) ? $transfers['time'][$key4] : "";

                    $dataTransfer['image'] = isset($transfers['image'][$key4]) ? $transfers['image'][$key4] : "";

                    $dataTransfer['type_en'] = isset($transfers['type_en'][$key4]) ? $transfers['type_en'][$key4] : "";
                    $dataTransfer['type_ar'] = isset($transfers['type_ar'][$key4]) ? $transfers['type_ar'][$key4] : "";
                    $dataTransfer['pickup_location_en'] = isset($transfers['pickup_location_en'][$key4]) ? $transfers['pickup_location_en'][$key4] : "";
                    $dataTransfer['pickup_location_ar'] = isset($transfers['pickup_location_ar'][$key4]) ? $transfers['pickup_location_ar'][$key4] : "";
                    $dataTransfer['drop_off_location_en'] = isset($transfers['drop_off_location_en'][$key4]) ? $transfers['drop_off_location_en'][$key4] : "";
                    $dataTransfer['drop_off_location_ar'] = isset($transfers['drop_off_location_ar'][$key4]) ? $transfers['drop_off_location_ar'][$key4] : "";
                    Transfer::create($dataTransfer);
                }
            }
            if (isset($request->days)) {
                Day::where('package_id', $id)->delete();
                $days = $request->days;
                $dataDay['package_id'] = $package->id;
                foreach ($days['days'] as $key2 => $value) {
                    $dataDay['day_title_en'] = isset($days['title_en'][$key2]) ? $days['title_en'][$key2] : "";
                    $dataDay['day_title_ar'] = isset($days['title_ar'][$key2]) ? $days['title_ar'][$key2] : "";
                    $dataDay['day_description_ar'] = isset($days['description_ar'][$key2]) ? $days['description_ar'][$key2] : "";
                    $dataDay['day_description_en'] = isset($days['description_en'][$key2]) ? $days['description_en'][$key2] : "";
                    if (isset($days['open_day'][$key2])) {
                        $dataDay['open_day'] = $days['open_day'][$key2];
                    }

                    $dayModel = Day::create($dataDay);

                    if (isset($days['tours'][$key2])) {
                        $dataTour['day_id'] = $dayModel->id;
                        $dataTour['package_id'] = $id;
                        $tours = $days['tours'][$key2];
                        foreach ($tours as $tour) {
                            if ($tour) {
                                $dataTour['tour_id'] = $tour;
                                PackageDayTour::create($dataTour);
                            }
                        }
                    }
                }
            }
            if (isset($request->flights)) {
                Flight::where('package_id', $id)->delete();
                FlightSegment::where('package_id', $id)->delete();
                $flights = $request->flights;
                $dataFlight['package_id'] = $package->id;

                foreach ($flights['flights'] as $key5 => $value) {
                    $dataFlight['departure_from_en'] = isset($flights['departure_from_en'][$key5]) ? $flights['departure_from_en'][$key5] : "";
                    $dataFlight['departure_from_ar'] = isset($flights['departure_from_ar'][$key5]) ? $flights['departure_from_ar'][$key5] : "";
                    $dataFlight['departure_to_en'] = isset($flights['departure_to_en'][$key5]) ? $flights['departure_to_en'][$key5] : "";
                    $dataFlight['departure_to_ar'] = isset($flights['departure_to_ar'][$key5]) ? $flights['departure_to_ar'][$key5] : "";

                    $flightModel = Flight::create($dataFlight);

                    if (isset($flights['segments'][$key5])) {
                        $segments = $flights['segments'][$key5];
                        $dataSegment['package_id'] = $package->id;
                        $dataSegment['flight_id'] = $flightModel->id;

                        foreach ($segments['segments'] as $key7 => $value) {

                            if (isset($segments['departure_date'][$key7]))
                                $dataSegment['departure_date'] = Carbon::createFromTimestamp(strtotime($segments['departure_date'][$key7]))->format('Y-m-d');
                            $dataSegment['departure_time'] = isset($segments['departure_time'][$key7]) ? $segments['departure_time'][$key7] : null;
                            if (isset($segments['arrival_date'][$key7]))
                                $dataSegment['arrival_date'] = Carbon::createFromTimestamp(strtotime($segments['arrival_date'][$key7]))->format('Y-m-d');
                            $dataSegment['arrival_time'] = isset($segments['arrival_time'][$key7]) ? $segments['arrival_time'][$key7] : null;
                            $dataSegment['flight_number'] = isset($segments['flight_number'][$key7]) ? $segments['flight_number'][$key7] : "";

                            $dataSegment['departure_from_en'] = isset($segments['departure_from_en'][$key7]) ? $segments['departure_from_en'][$key7] : "";
                            $dataSegment['departure_from_ar'] = isset($segments['departure_from_ar'][$key7]) ? $segments['departure_from_ar'][$key7] : "";
                            $dataSegment['arrival_to_en'] = isset($segments['arrival_to_en'][$key7]) ? $segments['arrival_to_en'][$key7] : "";
                            $dataSegment['arrival_to_ar'] = isset($segments['arrival_to_ar'][$key7]) ? $segments['arrival_to_ar'][$key7] : "";
                            $dataSegment['flight_en'] = isset($segments['flight_en'][$key7]) ? $segments['flight_en'][$key7] : "";
                            $dataSegment['flight_ar'] = isset($segments['flight_ar'][$key7]) ? $segments['flight_ar'][$key7] : "";

                            if ($request->has('flights.segments.' . $key5 . '.icon.' . $key7) != null) {
                                $icon = $segments['icon'][$key7];
                                $imageName = time() . '.flighticon' . $icon->getClientOriginalExtension();
                                $icon->storeAs($this->imagePath, $imageName);
                                $dataSegment['icon'] = $imageName;
                            } else {
                                $dataSegment['icon'] = $segments['last_icon'][$key7];
                            }
                            FlightSegment::create($dataSegment);
                            unset($dataSegment);

                        }
                        unset($segments);
                    }
                }
            }

            if (isset($request->hotel)) {

                PackageHotel::where('package_id', $id)->delete();
                PackageHotelSegment::where('package_id', $id)->delete();
                PackageHotelPricing::where('package_id', $id)->delete();
                PackageHotelPricingDetail::where('package_id', $id)->delete();

                $all_hotels = $request->hotel;

                $dataHotel['package_id'] = $package->id;

                foreach ($all_hotels['hotel_id'] as $i => $hotel_id) {

                    $dataHotel['hotel_id'] = $hotel_id;
                    $dataHotel['price'] = $all_hotels['price'][$i];

                    if (isset($all_hotels['check_in'][$i]))
                        $dataHotel['check_in'] = Carbon::createFromTimestamp(strtotime($all_hotels['check_in'][$i]))->format('Y-m-d');
                    else
                        $dataHotel['check_in'] = null;

                    if (isset($all_hotels['check_out'][$i]))
                        $dataHotel['check_out'] = Carbon::createFromTimestamp(strtotime($all_hotels['check_out'][$i]))->format('Y-m-d');
                    else
                        $dataHotel['check_out'] = null;

                    if (isset($all_hotels['bookable'][$i]))
                        $dataHotel['bookable'] = $all_hotels['bookable'][$i];
                    else
                        $dataHotel['bookable'] = '0';

                    if (isset($all_hotels['sold_out'][$i]))
                        $dataHotel['sold_out'] = $all_hotels['sold_out'][$i];
                    else
                        $dataHotel['sold_out'] = '0';

                    if (isset($all_hotels['enquiry'][$i]))
                        $dataHotel['enquiry'] = $all_hotels['enquiry'][$i];
                    else
                        $dataHotel['enquiry'] = '0';


                    $PackageHotel = PackageHotel::create($dataHotel);
                    $dataPricing['package_id'] = $package->id;
                    $dataPricing['hotel_id'] = $hotel_id;
                    $dataPricing['package_hotel_id'] = $PackageHotel->id;

                    if (isset($all_hotels['packagehotelpricing'])) {
                        $packagehotelpricing = $all_hotels['packagehotelpricing'];

                        $dataPricing['adult_1'] = $packagehotelpricing['adult_1'][$i];
                        $dataPricing['adult_2'] = $packagehotelpricing['adult_2'][$i];
                        $dataPricing['adult_3'] = $packagehotelpricing['adult_3'][$i];
                        $dataPricing['child_0_2_1'] = $packagehotelpricing['child_0_2_1'][$i];
                        $dataPricing['child_0_2_2'] = $packagehotelpricing['child_0_2_2'][$i];
                        $dataPricing['child_0_2_3'] = $packagehotelpricing['child_0_2_3'][$i];
                        $dataPricing['child_3_5_1'] = $packagehotelpricing['child_3_5_1'][$i];
                        $dataPricing['child_3_5_2'] = $packagehotelpricing['child_3_5_2'][$i];
                        $dataPricing['child_3_5_3'] = $packagehotelpricing['child_3_5_3'][$i];
                        $dataPricing['child_6_11_1'] = $packagehotelpricing['child_6_11_1'][$i];
                        $dataPricing['child_6_11_2'] = $packagehotelpricing['child_6_11_2'][$i];
                        $dataPricing['child_6_11_3'] = $packagehotelpricing['child_6_11_3'][$i];

                        PackageHotelPricing::create($dataPricing);
                    }
                    if (isset($all_hotels['pricing'][$i]['pricing'])) {
                        $dataPricingDetail['package_id'] = $package->id;
                        $dataPricingDetail['hotel_id'] = $hotel_id;
                        $dataPricingDetail['package_hotel_id'] = $PackageHotel->id;
                        foreach ($all_hotels['pricing'][$i]['pricing'] as $key5 => $value) {

                            $dataPricingDetail['cost_en'] = isset($all_hotels['pricing'][$i]['cost_en'][$key5]) ? $all_hotels['pricing'][$i]['cost_en'][$key5] : "";
                            $dataPricingDetail['cost_ar'] = isset($all_hotels['pricing'][$i]['cost_ar'][$key5]) ? $all_hotels['pricing'][$i]['cost_ar'][$key5] : "";
                            $dataPricingDetail['value_ar'] = isset($all_hotels['pricing'][$i]['value_ar'][$key5]) ? $all_hotels['pricing'][$i]['value_ar'][$key5] : "";
                            $dataPricingDetail['value_en'] = isset($all_hotels['pricing'][$i]['value_en'][$key5]) ? $all_hotels['pricing'][$i]['value_en'][$key5] : "";
                            PackageHotelPricingDetail::create($dataPricingDetail);
                        }
                    }

                    if (isset($all_hotels['segments'][$i]['segments'])) {
                        $dataHotelSegment['package_id'] = $package->id;
                        $dataHotelSegment['main_hotel_id'] = $hotel_id;
                        $dataHotelSegment['package_hotel_id'] = $PackageHotel->id;

                        foreach ($all_hotels['segments'][$i]['segments'] as $key6 => $value) {
                            $dataHotelSegment['hotel_id'] = $all_hotels['segments'][$i]['hotel_id'][$key6];
                            if (isset($all_hotels['segments'][$i]['check_in'][$key6]))
                                $dataHotelSegment['check_in'] = Carbon::createFromTimestamp(strtotime($all_hotels['segments'][$i]['check_in'][$key6]))->format('Y-m-d');
                            if (isset($all_hotels['segments'][$i]['check_out'][$key6]))
                                $dataHotelSegment['check_out'] = Carbon::createFromTimestamp(strtotime($all_hotels['segments'][$i]['check_out'][$key6]))->format('Y-m-d');

                            PackageHotelSegment::create($dataHotelSegment);

                        }
                    }

                }
            } else {
                PackageHotel::where('package_id', $id)->delete();
                PackageHotelSegment::where('package_id', $id)->delete();
                PackageHotelPricing::where('package_id', $id)->delete();
                PackageHotelPricingDetail::where('package_id', $id)->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('admin.packages.index', ['country' => $package->country_id]);
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('admin.packages.index', ['country' => $package->country_id]);
    }

    public function showOrderForm($country)
    {
        $packages = Package::where('country', $country)->orderBy('package_order', 'ASC')->get();
        $country = Country::findOrFail($country);
        return view('backend.package.order', compact('packages', 'country'));
    }

    public function saveOrder(Request $request)
    {
        if (isset($request->package)) {
            $packages = $request->package;
            foreach ($packages as $id => $order) {
                $package = Package::findOrFail($id);
                $package->update(['package_order' => $order]);
            }
        }
        return redirect()->route('admin.packages.order', ['country' => $package->country]);
    }
}
