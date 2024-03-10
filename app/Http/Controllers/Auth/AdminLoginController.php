<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        
        // Validate form data
        $this->validate($request, [
        //    'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password],0))
        {
            return redirect()->intended(route('admin.dashboard'));
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('username'));
    }
}
