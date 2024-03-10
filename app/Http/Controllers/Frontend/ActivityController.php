<?php

namespace App\Http\Controllers\Frontend;

use App\ActivityBook;
use App\ActivityCard;
use App\ActivityCategory;
use App\ActivityCity;
use App\ActivityCountry;
use App\ActivityOrder;
use App\ActivityOrderPerson;
use App\ActivityStep;
use App\ActivityTour;
use App\ActivityType;
use App\GeneralInformation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StripePaymentController;
use App\Mail\ActivityAdmin;
use App\Mail\ActivityMember;
use App\SiteSetting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{
    public function __construct()
    {
        if (Config::get('global_models.activity') == '1') {
//            abort(404);
        }

    }

    public function index()
    {
        $steps = ActivityStep::all();
        $activities = ActivityTour::Publish()->Home()->get();
        $general_info = GeneralInformation::where('type', 'activity')->first();
        $activity_countries = ActivityCountry::all();
        $cities = ActivityCity::all();
        $types = ActivityType::all();
        $whatsapp = SiteSetting::where('name', 'whatsapp_activity')->first();

        return view('frontend.activity.index')
            ->with(['steps' => $steps,
                'activities' => $activities,
                'info' => $general_info,
                'activity_countries' => $activity_countries,
                'cities' => $cities,
                'types' => $types,
                'whatsapp' => $whatsapp
            ]);
    }

    public function search(Request $request)
    {

        $model = new ActivityTour();

        if (isset($request->category)) {
            $model = $model->whereHas('categories', function ($query) use ($request) {
                $query->where('activity_category_id', $request->category);

                if (isset($request->service)) {
                    $query->where('activity_tour_categories.type', $request->service);
                }
            });
        } elseif (isset($request->service)) {
            $model = $model->whereHas('categories', function ($query) use ($request) {
                $query->where('activity_tour_categories.type', $request->service);
            });
        }

        if (isset($request->country) && $request->country) {
            $model = $model->where('activity_country_id', $request->country);
            $cities = ActivityCity::where('activity_country_id', $request->country)->get();
        } else {
            $cities = ActivityCity::all();
        }

        if (isset($request->city))
            $model = $model->where('activity_city_id', $request->city);

        if (isset($request->from)) {
//            $model = $model->where('date', '>=', Carbon::createFromTimestamp(strtotime($request->from))->format('Y-m-d'));
            $date_from = Carbon::createFromTimestamp(strtotime($request->from))->format('Y-m-d');
        } else
            $date_from = 0;

        if (isset($request->to)) {
//            $model = $model->where('cancellation_date', '<=', Carbon::createFromTimestamp(strtotime($request->to))->format('Y-m-d'));
            $date_to = Carbon::createFromTimestamp(strtotime($request->to))->format('Y-m-d');
        } else
            $date_to = 0;

        if (isset($request->name))
            $model = $model->where('name_en', 'like', '%' . $request->name . '%')
                ->orWhere('name_ar', 'like', '%' . $request->name . '%');

        if (isset($request->duration))
            $model = $model->where('activity_duration', $request->duration);

        if (isset($request->for)) {
            $model->whereHas('tourTypes', function ($query) use ($request) {
                $query->whereIn('activity_type_id', $request->for);
            });
        }
//            $model = $model->where('activity_for', $request->for);

        if (isset($request->price)) {
            $price = explode(',', $request->price);
            $model = $model->where('price', '>=', $price[0]);
            $model = $model->where('price', '<=', $price[1]);
        }

        $ageChild = [
            (isset($request->ageChild1)) ? $request->ageChild1 : 0,
            (isset($request->ageChild2)) ? $request->ageChild2 : 0,
            (isset($request->ageChild3)) ? $request->ageChild3 : 0,
            (isset($request->ageChild4)) ? $request->ageChild4 : 0,
            (isset($request->ageChild5)) ? $request->ageChild5 : 0,
        ];
        $numberPersonArr = [
            (isset($request->adult)) ? $request->adult : 0,
            (isset($request->ageChild1)) ? 1 : 0,
            (isset($request->ageChild2)) ? 1 : 0,
            (isset($request->ageChild3)) ? 1 : 0,
            (isset($request->ageChild4)) ? 1 : 0,
            (isset($request->ageChild5)) ? 1 : 0,
        ];

        $activities = $model->Publish()->get();
        $general_info = GeneralInformation::where('type', 'activity')->first();
        $activity_countries = ActivityCountry::all();

        $all_categories = ActivityCategory::all();
        if ($date_to && $date_from)
            $period = CarbonPeriod::create($date_from, $date_to);
        else
            $period = 0;
        $types = ActivityType::all();
//        $period = Carbon
        $whatsapp = SiteSetting::where('name', 'whatsapp_activity')->first();
        return view('frontend.activity.activities')
            ->with([
                'activities' => $activities,
                'info' => $general_info,
                'activity_countries' => $activity_countries,
                'cities' => $cities,
                'all_categories' => $all_categories,
                'ageChild' => $ageChild,
                'numberPerson' => array_sum($numberPersonArr),
                'period' => $period,
                'types' => $types,
                'whatsapp' => $whatsapp
            ]);
    }

    public function viewActivity(Request $request)
    {
        $activity = ActivityTour::findOrFail($request->id);
        return response()->json(['data' => view('frontend.ajax.viewActivity',
            ['activity' => $activity])->render()], 200);
    }

    public function getCityOfCountry(Request $request)
    {
        $cities = ActivityCity::where('activity_country_id', $request->country)->get();
        return response()->json(['data' => view('frontend.ajax.getCityOfCountry',
            ['cities' => $cities])->render()], 200);
    }

    public function addActivityToCard(Request $request)
    {
        $order = ActivityOrder::where('member_id', Auth::guard('member')->user()->getAuthIdentifier())->whereDoesntHave('book')->first();
        if (!$order) {
            $dataOrder['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
            $order = ActivityOrder::create($dataOrder);
        }
        $dataCard['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
        $dataCard['activity_tour_category_id'] = $request->id;
        $dataCard['activity_category_id'] = $request->category_id;
        $dataCard['activity_tour_id'] = $request->activity_id;
        $dataCard['activity_order_id'] = $order->id;
        if (isset($request->date) && $request->date != 'NaN')
            $dataCard['date'] = $request->date;
        $dataCard['price'] = $request->price;
        $dataCard['adult'] = $request->adult;
        if (isset($request->child) && $request->child != 'NaN')
            $dataCard['child'] = $request->child;
        if (isset($request->ageChild1) && $request->ageChild1 != 'NaN')
            $dataCard['age_child_1'] = $request->ageChild1;
        if (isset($request->ageChild2) && $request->ageChild2 != 'NaN')
            $dataCard['age_child_2'] = $request->ageChild2;
        if (isset($request->ageChild3) && $request->ageChild3 != 'NaN')
            $dataCard['age_child_3'] = $request->ageChild3;
        if (isset($request->ageChild4) && $request->ageChild4 != 'NaN')
            $dataCard['age_child_4'] = $request->ageChild4;
        if (isset($request->ageChild5) && $request->ageChild5 != 'NaN')
            $dataCard['age_child_5'] = $request->ageChild5;

        ActivityCard::create($dataCard);

    }

    public function deleteActivityFromCard(Request $request)
    {
        $card = ActivityCard::findOrFail($request->id);
        $card->delete($request->id);
    }

    public function deleteActivityFromCardNew(Request $request)
    {
        $id = $request->id;

        $cookie_data = stripslashes(Cookie::get('activity_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'id');
        $prod_id_is_there = $id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["id"] == $id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 360;
                    Cookie::queue(Cookie::make('activity_cart', $item_data, $minutes));
                }
            }
        }
    }

    public function activityCard()
    {
//        if (!Auth::guard('member')->user()) {
//            return redirect()->route('member.login');
//        }
        $types = ActivityType::all();
        $whatsapp = SiteSetting::where('name', 'whatsapp_activity')->first();
        return view('frontend.activity.card')->with(['types' => $types, 'whatsapp' => $whatsapp, 'whatsapp' => $whatsapp]);
    }

    public function saveCard(Request $request)
    {
        if (!Auth::guard('member')->user()) {
            return redirect()->route('member.login');
        }
        try {
            DB::beginTransaction();
            $order = ActivityOrder::findOrFail(Auth::guard('member')->user()->orderActivity->id);

//            $dataOrder['email'] = $request->email;
//            $dataOrder['hotel_name'] = $request->hotel_name;
//            $dataOrder['country_code'] = $request->country_code;
//            $dataOrder['mobile'] = $request->mobile;
//
//            $order->update($dataOrder);

            $dataBook['total_price'] = Auth::guard('member')->user()->orderActivity->card->sum('price');
            $dataBook['activity_order_id'] = Auth::guard('member')->user()->orderActivity->id;
            $dataBook['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

            ActivityBook::create($dataBook);

            $dataOrderPerson['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
            $dataOrderPerson['activity_order_id'] = Auth::guard('member')->user()->orderActivity->id;
            foreach (Auth::guard('member')->user()->orderActivity->card as $card) {

                $info = $request->info;
                $dataCard['email'] = $info[$card->id]['email'];
                $dataCard['drop_off'] = $info[$card->id]['drop_off'];
                $dataCard['pick_up'] = $info[$card->id]['pick_up'];
                $dataCard['country_code'] = $info[$card->id]['country_code'];
                $dataCard['mobile'] = $info[$card->id]['mobile'];
                $card->update($dataCard);

                $persons = $request->person;
                $dataOrderPerson['activity_card_id'] = $card->id;
                for ($i = 0; $i < intval($card->adult); $i++) {
                    $dataOrderPerson['first_name'] = $persons[$card->id]['firstname'][$i];
                    $dataOrderPerson['last_name'] = $persons[$card->id]['lastname'][$i];
                    $dataOrderPerson['is_main'] = $persons[$card->id]['main_passenger'];
                    ActivityOrderPerson::create($dataOrderPerson);
                    if ($persons[$card->id]['main_passenger'] == '1')
                        break;
                }
            }
            DB::commit();
            Alert::success(trans('alert.success_enquiry_sent'), trans('alert.success-add-activity'))->showConfirmButton(trans('alert.confirmButtonOk'));

        } catch (\Exception $e) {
            DB::rollBack();
            Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));

//             throw $e;
        }
        return redirect()->route('activity.index');
    }

    public function addActivityChildren(Request $request)
    {
        $number = $request->number;
        return response()->json(['data' => view('frontend.ajax.addActivityChildren',
            ['number' => $number])->render()], 200);
    }

    public function setPersonActivityCard(Request $request)
    {
        $number = $request->number;
        $card = $request->card;
        return response()->json(['data' => view('frontend.ajax.setPersonActivityCard',
            ['number' => $number, 'card' => $card])->render()], 200);
    }

    public function addActivityToCardNew(Request $request)
    {

        if (Cookie::get('activity_cart')) {
            $cookie_data = stripslashes(Cookie::get('activity_cart'));
            $cart_data = json_decode($cookie_data, true);

        } else {
            $cart_data = array();
        }

        $activity_id = $request->activity_id;
        $activity = ActivityTour::findOrFail($activity_id);

        $category_id = $request->category_id;
        $activity_id_list = array_column($cart_data, 'activity_id');

        $age_children = [];
        if (isset($request->ageChild1) && $request->ageChild1 != 'NaN') {
            $age_child_1 = $request->ageChild1;
            $age_children[] = $age_child_1;
        } else {
            $age_child_1 = 0;
        }
        if (isset($request->ageChild2) && $request->ageChild2 != 'NaN') {
            $age_child_2 = $request->ageChild2;
            $age_children[] = $age_child_2;
        } else {
            $age_child_2 = 0;
        }
        if (isset($request->ageChild3) && $request->ageChild3 != 'NaN') {
            $age_child_3 = $request->ageChild3;
            $age_children[] = $age_child_3;
        } else {
            $age_child_3 = 0;
        }
        if (isset($request->ageChild4) && $request->ageChild4 != 'NaN') {
            $age_child_4 = $request->ageChild4;
            $age_children[] = $age_child_4;
        } else {
            $age_child_4 = 0;
        }
        if (isset($request->ageChild5) && $request->ageChild5 != 'NaN') {
            $age_child_5 = $request->ageChild5;
            $age_children[] = $age_child_5;
        } else {
            $age_child_5 = 0;
        }

        $price = $activity->totalPrice($request->adult, (intval($request->adult) + intval($request->child)), $age_children, $activity_id, $category_id);
        if (in_array($activity_id, $activity_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["activity_id"] == $activity_id && $cart_data[$keys]["category_id"] == $category_id) {
                    $cart_data[$keys]["date"] = Carbon::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');
                    $cart_data[$keys]["adult"] = $request->adult;
                    $cart_data[$keys]["child"] = $request->child;
                    $cart_data[$keys]["ageChild1"] = $age_child_1;
                    $cart_data[$keys]["ageChild2"] = $age_child_2;
                    $cart_data[$keys]["ageChild3"] = $age_child_3;
                    $cart_data[$keys]["ageChild4"] = $age_child_4;
                    $cart_data[$keys]["ageChild5"] = $age_child_5;
                    $cart_data[$keys]["price"] = $price;
                    $cart_data[$keys]["created_at"] = Carbon::now()->format('Y-m-d');

                }
            }
        } else {
            $cart_data[$request->id]["id"] = $request->id;
            $cart_data[$request->id]["category_id"] = $request->category_id;
            $cart_data[$request->id]["activity_id"] = $request->activity_id;
            $cart_data[$request->id]["adult"] = $request->adult;
            $cart_data[$request->id]["child"] = $request->child;
            $cart_data[$request->id]["date"] = Carbon::createFromFormat('Y-m-d', $request->date)->format('Y-m-d');
            $cart_data[$request->id]["ageChild1"] = $age_child_1;
            $cart_data[$request->id]["ageChild2"] = $age_child_2;
            $cart_data[$request->id]["ageChild3"] = $age_child_3;
            $cart_data[$request->id]["ageChild4"] = $age_child_4;
            $cart_data[$request->id]["ageChild5"] = $age_child_5;
            $cart_data[$request->id]["price"] = $price;
            $cart_data[$request->id]["created_at"] = Carbon::now()->format('Y-m-d');

        }
        $item_data = json_encode($cart_data);
        $minutes = 360;
        Cookie::queue(Cookie::make('activity_cart', $item_data, $minutes));
    }

    public function saveCardNew(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptchav3:activities,0.5'
        ]);

//        if (!Auth::guard('member')->user()) {
//            return redirect()->route('member.login');
//        }
        try {
            DB::beginTransaction();
//            $dataOrder['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
            $order = ActivityOrder::create();


//            $dataOrderPerson['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
            $dataOrderPerson['activity_order_id'] = $order->id;

            if (Cookie::get('activity_cart')) {
                $cookie_data = stripslashes(Cookie::get('activity_cart'));
                $cart_data = json_decode($cookie_data, true);
                $total_cart_price = 0;

//                $dataCard['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();
                $dataCard['activity_order_id'] = $order->id;

                foreach ($cart_data as $card) {
                    $total_cart_price += $card['price'];

                    $dataCard['activity_tour_category_id'] = $card['id'];
                    $dataCard['activity_category_id'] = $card['category_id'];
                    $dataCard['activity_tour_id'] = $card['activity_id'];

                    $dataCard['date'] = $card['date'];
                    $dataCard['price'] = $card['price'];
                    $dataCard['adult'] = $card['adult'];
                    $dataCard['child'] = $card['child'];
                    $dataCard['age_child_1'] = $card['ageChild1'];
                    $dataCard['age_child_2'] = $card['ageChild2'];
                    $dataCard['age_child_3'] = $card['ageChild3'];
                    $dataCard['age_child_4'] = $card['ageChild4'];
                    $dataCard['age_child_5'] = $card['ageChild5'];

                    $info = $request->info;
                    $dataCard['email'] = $info[$card['id']]['email'];
                    $dataCard['drop_off'] = isset($info[$card['id']]['drop_off']) ? $info[$card['id']]['drop_off'] : "";
                    $dataCard['pick_up'] = isset($info[$card['id']]['pick_up']) ? $info[$card['id']]['pick_up'] : "";
                    $dataCard['country_code'] = $info[$card['id']]['country_code'];
                    $dataCard['mobile'] = $info[$card['id']]['mobile'];
                    $this_card = ActivityCard::create($dataCard);

                    $persons = $request->person;
                    $dataOrderPerson['activity_card_id'] = $this_card->id;
                    for ($i = 0; $i < intval($card['adult']); $i++) {
                        $dataOrderPerson['first_name'] = $persons[$card['id']]['firstname'][$i];
                        $dataOrderPerson['last_name'] = $persons[$card['id']]['lastname'][$i];
                        $dataOrderPerson['is_main'] = $persons[$card['id']]['main_passenger'];
                        ActivityOrderPerson::create($dataOrderPerson);
                        if ($persons[$card['id']]['main_passenger'] == '1')
                            break;
                    }
                }
            }

            $dataBook['total_price'] = $total_cart_price;
            $dataBook['activity_order_id'] = $order->id;
            if (Auth::guard('member')->check())
                $dataBook['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

            ActivityBook::create($dataBook);

            DB::commit();
            if (isset($request->activity_checkout)) {
                $order->active = 0;
                $order->enquiry = 0;
                $order->save();

                $items = [];
                if (Cookie::get('activity_cart')) {
                    $cookie_data = stripslashes(Cookie::get('activity_cart'));
                    $cart_data = json_decode($cookie_data, true);

                    foreach ($cart_data as $card) {
                        $activity = ActivityTour::findOrFail($card['activity_id']);
                        $items[] = [
                            'price_data' => [
                                'currency' => 'AED',
                                'product_data' => [
                                    'name' => $activity->name
                                ],
                                'unit_amount' => (intval($card['price']) * 100),
                            ],
                            'quantity' => 1,
                        ];
                    }
                }
                $StripePaymentController = new StripePaymentController();
                return $StripePaymentController->create_activity_checkout_session($items,$order->id);
            } else {
//                Mail::to($order->card[0]->email)->send(new ActivityMember($order));
//                Mail::to(config("app.to.address"))->send(new ActivityAdmin($order));

                Alert::success(trans('alert.success_enquiry_sent'), trans('alert.success-add-activity'))->showConfirmButton(trans('alert.confirmButtonOk'));
            }
            Cookie::queue(Cookie::forget('activity_cart'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
        }

        return redirect()->route('activity.index');
    }
}
