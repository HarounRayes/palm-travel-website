<?php

namespace App\Http\Controllers\Auth;

use App\Blog;
use App\GlobalModel;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class MemberLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.member-register');
    }
    public function showRegisterForm()
    {
        return view('auth.member-register');
    }
    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if(Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password ]))
        {
            return redirect()->intended(route('member.account'));
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email'));
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

}
