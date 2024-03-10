<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityTour;
use App\Day;
use App\Enquiry;
use App\EnquiryTour;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Mail\HeaderEnquiry;
use App\OrderTour;
use App\Package;
use App\PackageDayTour;
use App\PackageHotelPricing;
use App\PackageHotelPricingDetail;
use App\Room;
use App\Tour;
use App\VisaUaeNationality;
use App\VisaUaeNationalityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class AjaxController extends Controller
{

    public function enquiryHeader()
    {
        return response()->json(['data' => view('frontend.ajax.enquiryHeader')->render()], 200);
    }

    public function sendEnquiryHeader(Request $request)
    {
        $dataForm = $request->all();
        $enquiry = Enquiry::findOrFail($dataForm['enquiry_id']);
        Mail::to()->send(new HeaderEnquiry($enquiry));
    }

    public function enquiry(Request $request)
    {

        $tours = OrderTour::where('session_id', Session::getId())->get();

        if (isset($request->form)) {
            $form = array_column($request->form, 'value', 'name');
            $dataEnquiry['package_hotel_id'] = $form['hotel_package_id'];
            $dataEnquiry['package_id'] = $form['package_id'];
            $dataEnquiry['hotel_id'] = $form['hotel_id'];
            $dataEnquiry['cost'] = $form['cost'];
            $dataEnquiry['num_room'] = $form['room-counter'] + 1;

            if($form['is_booking'])
                $dataEnquiry['is_enquiry'] = 0;

            if (Auth::guard('member')->check()) {
                $dataEnquiry['member_id'] = Auth::guard('member')->id();
            }
            $res = Enquiry::create($dataEnquiry);
            $all_person = 0;
            if ($res) {
                $dataRoom['package_id'] = intval($form['package_id']);
                $dataRoom['enquiry_id'] = $res->id;
                for ($i = 0; $i < ($form['room-counter'] + 1); $i++) {

                    $dataRoom['num_adult'] = $form['num-adult-' . $i];
                    $all_person = $all_person + $dataRoom['num_adult'];
                    if (isset($form['num-Child-0-' . $i]) && isset($form['num-Child-1-' . $i])) {
                        $dataRoom['num_child'] = $form['num-child-' . $i];
                        $dataRoom['age_child_1'] = $form['num-Child-0-' . $i];
                        $dataRoom['age_child_2'] = $form['num-Child-1-' . $i];
                    } else {
                        $dataRoom['num_child'] = 0;
                        $dataRoom['age_child_1'] = 0;
                        $dataRoom['age_child_2'] = 0;
                    }
                    $all_person = $all_person + $dataRoom['num_child'];
                    $dataRoom['room_cost'] = $form['room-cost-' . $i];
                    Room::create($dataRoom);
                }


                foreach ($tours as $tour) {
                    $datatour['tour_id'] = intval($tour['tour_id']);
                    $datatour['day_id'] = intval($tour['day_id']);
                    $datatour['package_id'] = intval($form['package_id']);
                    $datatour['enquiry_id'] = $res->id;
                    $datatour['adult_number'] = $tour['adult_number'];
                    $datatour['child_number'] = $tour['child_number'];
                    $datatour['child_number_2'] = $tour['child_number_2'];
//                    $datatour['child_age_1'] = $tour['child_age_1'];
//                    $datatour['child_age_2'] = $tour['child_age_2'];
                    $datatour['tour_cost'] = $tour['tour_cost'];
                    $datatour['number_day'] = intval($tour['number_day']);
                    EnquiryTour::create($datatour);
                }
            }
        }
        $package = Package::findOrFail($form['package_id']);

        return response()->json(['data' => view('frontend.ajax.enquiry',
            [
                'package' => $package,
                'enquiry' => $res,
                'tours' => $tours,
                'rooms' => Room::where('enquiry_id', $res->id)->get(),
                'package_hotel_id' => $form['hotel_package_id'],
                'hotel_id' => $form['hotel_id'],
                'all_person' => $all_person,
                'is_booking' => $form['is_booking']
            ]
        )->render()], 200);
    }

    public function sendEnquiry(Request $request)
    {
        $dataForm = $request->all();

        $enquiry = Enquiry::findOrFail($dataForm['enquiry_id']);
        Mail::to()->send(new \App\Mail\Enquiry($enquiry));
    }

    public function addToFavorite(Request $request)
    {

        if (!in_array($request->package_id, Auth::guard('member')->user()->favorites_ids())) {
            $dataIn['member_id'] = Auth::guard('member')->id();
            $dataIn['package_id'] = $request->package_id;
            Favorite::create($dataIn);
        }

    }

    public function DeleteFromFavorite(Request $request)
    {
        $favorite = Favorite::findOrFail($request->id);
        $favorite->delete();

    }

    public function DeleteFavorite(Request $request)
    {
        Favorite::where('id', $request->id)->delete();

    }

    public function cost(Request $request)
    {
        $adult = $request->adult;
        $child1 = $request->child1;
        $child2 = $request->child2;

        $result = 0;
        $child_0_2 = 0;
        $child_3_5 = 0;
        $child_6_10 = 0;

        $pricing = PackageHotelPricing::where('package_hotel_id', $request->hotel_package_id)->firstOrFail();

        if ($adult == 1) {
            $result = $result + $pricing->adult_1;
        } elseif ($adult == 2) {
            $result = $result + $pricing->adult_2;
        } elseif ($adult == 3) {
            $result = $result + $pricing->adult_3;
        }

        if ($child1 > 0 && $child1 <= 2) {
            $child_0_2 = $child_0_2 + 1;
        } elseif ($child1 >= 3 && $child1 <= 5) {
            $child_3_5 = $child_3_5 + 1;
        } elseif ($child1 >= 6 && $child1 <= 11) {
            $child_6_10 = $child_6_10 + 1;
        }


        if ($child2 > 0 && $child2 <= 2) {
            $child_0_2 = $child_0_2 + 1;
        } elseif ($child2 >= 3 && $child2 <= 5) {
            $child_3_5 = $child_3_5 + 1;
        } elseif ($child2 >= 6 && $child2 <= 11) {
            $child_6_10 = $child_6_10 + 1;
        }


        if ($child_0_2 == 1) {
            $result = $result + $pricing->child_0_2_1;
        } elseif ($child_0_2 == 2) {
            $result = $result + $pricing->child_0_2_2;
        } elseif ($child_0_2 == 3) {
            $result = $result + $pricing->child_0_2_3;
        }

        if ($child_3_5 == 1) {
            $result = $result + $pricing->child_3_5_1;
        } elseif ($child_3_5 == 2) {
            $result = $result + $pricing->child_3_5_2;
        } elseif ($child_3_5 == 3) {
            $result = $result + $pricing->child_3_5_3;
        }

        if ($child_6_10 == 1) {
            $result = $result + $pricing->child_6_11_1;
        } elseif ($child_6_10 == 2) {
            $result = $result + $pricing->child_6_11_2;
        } elseif ($child_6_10 == 3) {
            $result = $result + $pricing->child_6_11_3;
        }

        return response()->json(['data' => $result], 200);
    }

    public function addChild(Request $request)
    {
        $number = $request->number;
        $counter = $request->counter;
        return response()->json(['data' => view('frontend.ajax.addChild', ['number' => $number, 'counter' => $counter])->render()], 200);
    }

    public function addRoom(Request $request)
    {
        $counter = $request->counter;
        return response()->json(['data' => view('frontend.ajax.addRoom', ['counter' => $counter])->render()], 200);
    }

    public function deleteOrder(Request $request)
    {

    }

    public function deleteEnquiry(Request $request)
    {
        $enquiry_id = $request->id;
        Enquiry::findOrFail($enquiry_id)->delete();
    }

    public function addTourChild(Request $request)
    {
        $number = $request->number;
        $counter = $request->counter;
        return response()->json(['data' => view('frontend.ajax.addTourChild', ['number' => $number, 'counter' => $counter])->render()], 200);
    }

    public function tourCost(Request $request)
    {
        $adult = $request->adult;
        $tour_id = $request->tour;
        $type = $request->type;

        $result = 0;
        $select_tour = Tour::findOrFail($tour_id);

        if ($type == '1') {
            if ($adult > 8 && $adult <= 12) {
                $result = $result + $select_tour['price_3'];
            } elseif ($adult > 4 && $adult <= 8) {
                $result = $result + $select_tour['price_2'];
            } elseif ($adult > 0 && $adult <= 4) {
                $result = $result + $select_tour['price_1'];
            }
        } elseif ($type == '2') {
            $result = $adult * $select_tour['price_bus'];
        }
        return response()->json(['data' => $result], 200);
    }

    public function addDayTour(Request $request)
    {
        $counter_tour = $request->counter_tour;
        $package_id = $request->package_id;

        $days = Day::where('package_id', $package_id)->get();
        return response()->json(['data' => view('frontend.ajax.addDayTour', ['counter_tour' => $counter_tour, 'days' => $days])->render()], 200);
    }

    public function viewDayTour(Request $request)
    {
        $day_id = $request->day_id;
        $package_id = $request->package_id;
        $number_day = $request->number_day;

        $dayTour = PackageDayTour::where('package_id', $package_id)->where('day_id', $day_id)->get();
        $this_session_tour = OrderTour::where('session_id', Session::getId())->where('day_id', $day_id)->get();
        $this_session_tour_ids = OrderTour::where('session_id', Session::getId())->where('day_id', $day_id)->pluck('tour_id')->toArray();

        return response()->json(['data' => view('frontend.ajax.viewDayTour',
            ['day_id' => $day_id, 'number_day' => $number_day, 'tours' => $dayTour, 'this_session_tour' => $this_session_tour,
                'this_session_tour_ids' => $this_session_tour_ids])
            ->render()], 200);

    }

    public function deleteAllTours(Request $request)
    {

    }

    public function addTourType(Request $request)
    {
        $tour = $request->tour;
        $day = $request->day;
        $j = $request->i;
        $car = $request->car;
        $bus = $request->bus;

        if ($bus == '1' && $car == '0') {
            $is_bus = true;
            $is_car = false;
        }
        if ($bus == '0' && $car == '1') {
            $is_bus = false;
            $is_car = true;
        }
        if ($bus == '1' && $car == '1') {
            $is_bus = false;
            $is_car = true;
        }
        return response()->json(['data' => view('frontend.ajax.addTourType',
            ['day' => $day, 'j' => $j, 'tour' => $tour, 'is_bus' => $is_bus, 'is_car' => $is_car, 'car' => $car, 'bus' => $bus])->render()], 200);
    }

    public function addTour(Request $request)
    {
        $tour = $request->tour;
        $type = $request->type;
        $i = $request->i;
        return response()->json(['data' => view('frontend.ajax.addTour',
            ['type' => $type, 'j' => $i, 'tour' => $tour])->render()], 200);
    }

    public function addTourBus(Request $request)
    {
        $tour = $request->tour;
        $type = $request->type;
        $i = $request->i;
        return response()->json(['data' => view('frontend.ajax.addTourBus',
            ['type' => $type, 'j' => $i, 'tour' => $tour])->render()], 200);
    }

    public function viewSessionTour(Request $request)
    {
        $tours = OrderTour::where('session_id', Session::getId())->get();
        return response()->json(['data' => view('frontend.ajax.viewSessionTour',
            ['tours' => $tours])->render()], 200);
    }

    public function addTourAll(Request $request)
    {
        $dataForm = $request->all();
        parse_str($dataForm["form"], $dataIn);
        $counter = $dataIn['add-tour-counter-all'];
        OrderTour::where('session_id', Session::getId())->where('day_id', intval($dataIn['day']))->delete();
        if ($counter) {
            for ($i = 0; $i < $counter; $i++) {
                if ($dataIn["is-isset-tour-" . $i] == '1') {
                    $datatour['member_id'] = Auth::guard('member')->id();
                    $tour = $dataIn['tour-id-' . $i];
                    $datatour['tour_id'] = intval($tour);
                    $datatour['session_id'] = Session::getId();
                    $datatour['adult_number'] = intval($dataIn['adult-' . $tour]);
                    $datatour['tour_cost'] = $dataIn['tour-cost-' . $tour];
                    $datatour['number_day'] = $dataIn['number_day'];
                    $datatour['type'] = $dataIn['tour-type-' . $tour];
                    $datatour['child_number'] = $dataIn['child-1-' . $tour];
                    $datatour['child_number_2'] = $dataIn['child-2-' . $tour];
                    $datatour['day_id'] = intval($dataIn['day']);
//                    var_dump($datatour);die();
                    OrderTour::create($datatour);
                }
            }
        }
    }

    public function deleteOneTour(Request $request)
    {
        $OrderTour = OrderTour::findOrFail($request->id);
        $OrderTour->delete();
    }

    public function viewFavorite(Request $request)
    {
        return response()->json(['data' => view('frontend.ajax.viewFavorite')->render()], 200);
    }

    public function tourBusCost(Request $request)
    {
        $tour = Tour::findOrFail($request->tour);
        $adult = $request->adult;
        $child_1 = $request->child1;
        $child_2 = $request->child2;

        $result = $adult * $tour->price_bus;
        $result += $child_1 * $tour->child_0_2;
        $result += $child_2 * $tour->child_2_12;
        return response()->json(['data' => $result], 200);
    }

    public function viewEnquiryDetails(Request $request)
    {
        $enquiry = Enquiry::findOrFail($request->id);
        return response()->json(['data' => view('frontend.ajax.viewEnquiryDetails', ['enquiry' => $enquiry])->render()], 200);
    }

    public function visaCost(Request $request)
    {
        $visa = VisaUaeNationalityType::findOrFail($request->visa);

        $adult = $request->adult;
        $child = $request->child;
        $infant = $request->infant;

        $result = $adult * intval($visa->adult_price);
        $result += $child * intval($visa->child_price);
        $result += $infant * intval($visa->infant_price);
        return response()->json(['price' => $result, 'person' => (intval($adult) + intval($child) + intval($infant))], 200);

    }

    public function setVisaType(Request $request)
    {
        $nationality = VisaUaeNationality::where('symbol', $request->visa)->firstOrFail();
        return response()->json(['data' => view('frontend.ajax.setVisaType', ['nationality' => $nationality])->render()], 200);

    }

    public function loginModal()
    {
        return response()->json(['data' => view('frontend.ajax.login')->render()], 200);
    }
}
