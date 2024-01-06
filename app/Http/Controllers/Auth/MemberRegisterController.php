<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member');
    }

    public function showRegisterForm()
    {
        return view('auth.member-register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
//        var_dump('$request');die();
        Member::create($request->all());

        return redirect()->intended(route('member.account'));
    }
}
