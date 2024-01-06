<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
                $data, 422));
        }
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'token' => $accessToken]);
    }

    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }

}
