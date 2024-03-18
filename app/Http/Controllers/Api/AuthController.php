<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->all();
        $validatedData = Validator::make($loginData, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                "message" => trans('exception.Validation-Error'),
                'data' => $validatedData->errors(),
                "count" => count($validatedData->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422),);
        }

        $user = Member::where('email', $loginData['email'])->first();
        
        if (!($user)) {
            return response() ->json(['message' => 'Invalid Email address'], 401);
        }
        
        if (!Hash::check($loginData['password'], $user->password)) {
            return response() ->json(['message' => 'Invalid Password'], 401);
        }

        if (!Auth::guard('member')->attempt($loginData)) {
            return response() ->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = Auth::guard('member')->user()->createToken($user->email)->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                "message" => trans('exception.Validation-Error'),
                'data' => $validatedData->errors(),
                "count" => count($validatedData->errors()),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422));
        }
        $request['password'] = Hash::make($request->password);

        $user = Member::create($request->all());

        $token = $user->createToken($user->email)->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

    public function info(){
        
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        return response()->json($user, 200);
    }

    public function changePasswordPassword(Request $request)
    {        
        $validatedData = Validator::make($request->all(), [
            'old' => 'required',
            'new' => 'required|min:8|max:64',
            'renew' => 'required|same:new',
        ]);
    
        
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                "message" => trans('exception.Validation-Error'),
                'data' => $validatedData->errors(),
                "status" => 422
            ];
            throw new HttpResponseException(response()->json(
                $data, 422),
            );
        }
        
        $user = Auth::user();

        if (Hash::check($request->old, $user->password) === true) {
            $user->password = hash::make($request->new);
            $user->save();
            return response()->json([
                "success" => true,
                "message" => "Password changed successfully",
                "status" => 200
            ], 200);
        } else {
            return response()->json(
                $data = [
                    'success' => false,
                    "message" => trans('exception.Validation-Error'),
                    'data' => $validatedData->errors(),
                    "count" => count($validatedData->errors()),
                    "status" => 422
                ], 
            422);
        }

    }

}
