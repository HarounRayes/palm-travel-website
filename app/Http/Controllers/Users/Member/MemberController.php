<?php

namespace App\Http\Controllers\Users\Member;


use App\ActivityCard;
use App\Blog;
use App\Enquiry;
use App\Favorite;
use App\GeneralInformation;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\Member;
use App\Rules\MatchOldPassword;
use App\SiteSetting;
use App\VisaUaeNationality;
use App\VisaUaeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function index()
    {
        return view('member');
    }

    public function account(){
       $user = Auth::guard('member')->user();
       $enquiries = Enquiry::where('member_id' ,Auth::guard('member')->id())->get();
       $favorites= Favorite::where('member_id' ,Auth::guard('member')->id())->get();

        $types = VisaUaeType::Home()->get();
        $nationalities = VisaUaeNationality::Home()->get();
        $general_info = GeneralInformation::where('type', 'uae')->first();
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();

        return view('member.account')->with([
            'user' => $user,'enquiries' => $enquiries,'favorites' => $favorites,
            'types' => $types,
            'nationalities' => $nationalities,
            'info' => $general_info,
            'whatsapp' => $whatsapp
        ]);

    }
    public function changePassword(){
        return view('member.changePassword');
    }

    public function savePassword(Request $request){

        $this->validate($request, [
            'old_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = Auth::guard('member')->user();

        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->route('member.account');
    }
}
