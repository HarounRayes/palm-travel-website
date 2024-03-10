<?php

namespace App\Http\Controllers\Frontend;

use App\Enquiry;
use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Mail\HeaderEnquiry;
use App\Mail\UserContact;
use App\Mail\UserEnquiry;
use App\Mail\UserHeaderEnquiry;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class MailController extends Controller
{
    public function sendEnquiryHeader(Request $request)
    {
        try {

            $dataIn = $request->all();

            $dataIn['custom'] = '1';
            $dataIn['complete'] = 1;
            if (Auth::guard('member')->check()) {
                $dataIn['member_id'] = Auth::guard('member')->id();
            }
            $enquiry = Enquiry::create($dataIn);

            Mail::to($enquiry['email'])->send(new UserHeaderEnquiry());
            Mail::to(config("app.to.address"))->send(new HeaderEnquiry($enquiry));

            Alert::success(trans('alert.success_enquiry_sent'), trans('alert.enqiury-success-message'))->showConfirmButton(trans('alert.confirmButtonOk'));
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
            return redirect()->back();
        }
    }

    public function sendEnquiry(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataForm = $request->all();
            if (Auth::check()) {
                $dataForm['member_id'] = Auth::guard('member')->id();
            }
            $dataForm['complete'] = 1;
            $enquiry = Enquiry::where('id', $dataForm['enquiry_id'])->withoutGlobalScopes()->firstOrFail();
            $enquiry->update($dataForm);
            $package = Package::findOrFail($dataForm['package_id']);

            $package->update(['used' => ($package->used + $dataForm['all_person'])]);

            Mail::to($enquiry->enquiry_email())->send(new UserEnquiry($enquiry));
            Mail::to(config("app.to.address"))->send(new \App\Mail\Enquiry($enquiry));

//            Mail::to($enquiry->email, $enquiry->name)->send(new \App\Mail\Enquiry($enquiry));
//            Mail::to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->send(new \App\Mail\Enquiry($enquiry));

            Alert::success(trans('alert.success_enquiry_sent'), trans('alert.enqiury-success-message'))->showConfirmButton(trans('alert.confirmButtonOk'));
            DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
            DB::rollBack();
        //    throw $e;
            return redirect()->back();
        }
    }

    public function sendContact(Request $request)
    {
        try {
            $data = $request->all();

            Mail::to($data['email'])->send(new UserContact());
            Mail::to(config("app.to.address"))->send(new Contact($request));

//            if (Mail::failures()) {
//                Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
//            } else {
                Alert::success(trans('alert.success_enquiry_sent'), trans('alert.send-contact-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
//            }
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::warning('', trans('alert.error-email'))->showConfirmButton(trans('alert.confirmButtonOk'));
            return redirect()->back();
        }
    }
}
