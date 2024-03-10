<?php


namespace App\Http\Controllers;

use App\ActivityOrder;
use App\ActivityTransaction;
use App\Enquiry;
use App\EnquiryTransaction;
use App\Mail\ActivityAdmin;
use App\Mail\ActivityAdminCheckout;
use App\Mail\ActivityMember;
use App\Mail\ActivityMemberCheckout;
use App\Mail\UserEnquiryCheckout;
use App\Mail\VisaUaeAdmin;
use App\Mail\VisaUaeAdminCheckout;
use App\Mail\VisaUaeMember;
use App\Mail\VisaUaeMemberCheckout;
use App\VisaUaeApplication;
use App\VisaUaeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class StripePaymentController extends Controller
{


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_activity_checkout_session($items, $order_id)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $items
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.activity.success', ['order' => $order_id]),
            'cancel_url' => route('stripe.activity.cancel', ['order' => $order_id]),
        ]);

        if ($session) {
            $session_data = json_decode(json_encode($session), true);
            if (isset($session_data['url'])) {
                if (Auth::guard('member')->check())
                    $transactionData['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

                $transactionData['activity_order_id'] = $order_id;
                $transactionData['payment_intent'] = $session_data['payment_intent'];
                $transactionData['transaction_id'] = $session_data['id'];
                $transactionData['currency'] = $session_data['currency'];
                $transactionData['amount'] = $session_data['amount_total'] / 100;

                ActivityTransaction::create($transactionData);
                return Redirect::to($session_data['url']);
            }
        }
        return redirect()->route('stripe.activity.failed', ['order' => $order_id]);
    }

    public function activity_success(Request $request)
    {

        $order = ActivityOrder::findOrFail($request->order);
        $order->active = 1;
        $order->is_paid = 1;
        $order->save();
        $order->transaction->payment_status = config('constans.transaction_status.success');
        $order->transaction->save();
        Cookie::queue(Cookie::forget('activity_cart'));
//        Mail::to($order->card[0]->email)->send(new ActivityMemberCheckout($order));
//        Mail::to(config("app.to.address"))->send(new ActivityAdminCheckout($order));

        return view('frontend.activity.success');
    }

    public function activity_cancel(Request $request)
    {
        $order = ActivityOrder::findOrFail($request->order);
        $order->transaction->payment_status = config('constans.transaction_status.cancel');
        $order->transaction->save();
        return view('frontend.activity.cancel');
    }

    public function activity_failed(Request $request)
    {
        $order = ActivityOrder::findOrFail($request->order);
        $order->transaction->status = config('constans.transaction_status.failed');
        $order->transaction->save();
        return view('frontend.activity.failed');
    }

    public function create_visa_uae_checkout_session($items, $application)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $items
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.visa.uae.success', ['application' => $application]),
            'cancel_url' => route('stripe.visa.uae.cancel', ['application' => $application]),
        ]);

        if ($session) {
            $session_data = json_decode(json_encode($session), true);
            if (isset($session_data['url'])) {
                if (Auth::guard('member')->check())
                    $transactionData['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

                $transactionData['application_id'] = $application;
                $transactionData['payment_intent'] = $session_data['payment_intent'];
                $transactionData['transaction_id'] = $session_data['id'];
                $transactionData['currency'] = $session_data['currency'];
                $transactionData['amount'] = $session_data['amount_total'] / 100;

                VisaUaeTransaction::create($transactionData);
                return Redirect::to($session_data['url']);
            }
        }
        return redirect()->route('stripe.visa.uae.failed', ['application' => $application]);
    }

    public function visa_uae_success(Request $request)
    {

        $application = VisaUaeApplication::findOrFail($request->application);

        $application->is_paid = 1;
        $application->active = 1;
        $application->save();
        $application->transaction->payment_status = config('constans.transaction_status.success');
        $application->transaction->save();

//        Mail::to($application->people[0]->emails()[0]->value)->send(new VisaUaeMemberCheckout($application));
//        Mail::to(config("app.to.address"))->send(new VisaUaeAdminCheckout($application));

        Alert::success(trans('alert.success_enquiry_sent'), trans('messages.visa-uae-enquiry-message'));

        return view('frontend.visa.uae.success');

    }

    public function visa_uae_cancel(Request $request)
    {
        $order = VisaUaeApplication::findOrFail($request->application);
        $order->transaction->payment_status = config('constans.transaction_status.cancel');
        $order->transaction->save();
        return view('frontend.visa.uae.cancel');
    }

    public function visa_uae_failed(Request $request)
    {
        $order = VisaUaeApplication::findOrFail($request->application);
        $order->transaction->status = config('constans.transaction_status.failed');
        $order->transaction->save();
        return view('frontend.visa.uae.failed');
    }


    public function create_package_checkout_session($items, $enquiry)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $items
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.package.success', ['enquiry' => $enquiry]),
            'cancel_url' => route('stripe.package.cancel', ['enquiry' => $enquiry]),
        ]);

        if ($session) {
            $session_data = json_decode(json_encode($session), true);
            if (isset($session_data['url'])) {
                if (Auth::guard('member')->check())
                    $transactionData['member_id'] = Auth::guard('member')->user()->getAuthIdentifier();

                $transactionData['enquiry_id'] = $enquiry;
                $transactionData['payment_intent'] = $session_data['payment_intent'];
                $transactionData['transaction_id'] = $session_data['id'];
                $transactionData['currency'] = $session_data['currency'];
                $transactionData['amount'] = $session_data['amount_total'] / 100;

                EnquiryTransaction::create($transactionData);
                return Redirect::to($session_data['url']);
            }
        }
        return redirect()->route('stripe.package.failed', ['enquiry' => $enquiry]);
    }

    public function package_success(Request $request)
    {

        $enquiry = Enquiry::findOrFail($request->enquiry);

        $enquiry->is_paid = 1;

        $enquiry->save();
        $enquiry->transaction->payment_status = config('constans.transaction_status.success');
        $enquiry->transaction->save();

//        Mail::to($enquiry->enquiry_email())->send(new UserEnquiryCheckout($enquiry));
//        Mail::to(config("app.to.address"))->send(new \App\Mail\Enquiry($enquiry));

        Alert::success(trans('alert.success_enquiry_sent'), trans('alert.enqiury-success-message'))->showConfirmButton(trans('alert.confirmButtonOk'));

        return view('frontend.package.success');

    }

    public function package_cancel(Request $request)
    {
        $order = Enquiry::where('id', $request->enquiry)->withoutGlobalScopes()->firstOrFail();
        $order->transaction->payment_status = config('constans.transaction_status.cancel');
        $order->transaction->save();
        return view('frontend.package.cancel');
    }

    public function package_failed(Request $request)
    {
        $order = Enquiry::where('id', $request->enquiry)->withoutGlobalScopes()->firstOrFail();
        $order->transaction->status = config('constans.transaction_status.failed');
        $order->transaction->save();
        return view('frontend.package.failed');
    }
}
