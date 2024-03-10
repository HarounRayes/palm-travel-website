<?php

namespace App\Http\Controllers\Auth;

use App\Blog;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\Member;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member')->except('logout');
    }

    public function showLoginForm()
    {
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();
        return view('auth.member-register',compact('whatsapp'));
    }

    public function showRegisterForm()
    {
        $whatsapp = SiteSetting::where('name', 'whatsapp_uae_visa')->first();
        return view('auth.member-register' , compact('whatsapp'));
    }

    public function login(Request $request)
    {
        Artisan::call('cache:clear');
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route('member.account'));
        }

        // if unsuccessful

        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $password =$request->password;
        $request['password'] = Hash::make($request->password);

        $member = Member::create($request->all());
        // Attempt to log the user in
        if ($member) {
            if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $password])) {
                return redirect()->intended(route('member.account'));
            }
        }
        return redirect()->back()->withInput($request->only('email'));
    }

}
