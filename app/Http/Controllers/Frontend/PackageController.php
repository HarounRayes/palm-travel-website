<?php


namespace App\Http\Controllers\Frontend;


use App\Enquiry;
use App\EnquiryTour;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StripePaymentController;
use App\OrderTour;
use App\Package;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    public function booking(Request $request)
    {
        $items = [];
        $tours = OrderTour::where('session_id', Session::getId())->get();
        $cost = 0;

        if (isset($request->form)) {
            $form = array_column($request->form, 'value', 'name');
            $dataEnquiry['package_hotel_id'] = $form['hotel_package_id'];
            $dataEnquiry['package_id'] = $form['package_id'];
            $dataEnquiry['hotel_id'] = $form['hotel_id'];
            $dataEnquiry['cost'] = $form['cost'];
            $dataEnquiry['num_room'] = $form['room-counter'] + 1;
            $dataEnquiry['is_enquiry'] = 0;

            if (Auth::guard('member')->check())
                $dataEnquiry['member_id'] = Auth::guard('member')->id();

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
                    $cost += $dataRoom['room_cost'];
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
                    $datatour['tour_cost'] = $tour['tour_cost'];
                    $datatour['number_day'] = intval($tour['number_day']);
                    $cost += $datatour['tour_cost'];
                    EnquiryTour::create($datatour);
                }
            }
        }
        $package = Package::findOrFail($form['package_id']);
        $items[] = [
            'price_data' => [
                'currency' => 'AED',
                'product_data' => [
                    'name' => $package->name
                ],
                'unit_amount' => (intval($cost) * 100),
            ],
            'quantity' => 1,
        ];
        $StripePaymentController = new StripePaymentController();
        return redirect()->away($StripePaymentController->create_package_checkout_session($items, $res->id));
    }

    public function add_order(Request $request)
    {

        $items = [];
        $dataIn = $request->all();
        $dataIn['complete'] = 1;
        $enquiry = Enquiry::where('id', $dataIn['enquiry_id'])->withoutGlobalScopes()->firstOrFail();
        $enquiry->update($dataIn);

        $package = Package::findOrFail($dataIn['package_id']);
        $items[] = [
            'price_data' => [
                'currency' => 'AED',
                'product_data' => [
                    'name' => $package->name
                ],
                'unit_amount' => (intval($enquiry['cost']) * 100),
            ],
            'quantity' => 1,
        ];
        $StripePaymentController = new StripePaymentController();
        return $StripePaymentController->create_package_checkout_session($items, $dataIn['enquiry_id']);
    }
}
