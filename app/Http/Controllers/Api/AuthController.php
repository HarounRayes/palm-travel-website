<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
use App\Favorite;
use App\Enquiry;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\FavoritesResource;
use App\Http\Resources\User\EnquiriesResource;


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
        return response()->json(
            [
                "success" => true,
                "message" => "",
                "data" => new UserResource($user),
                "total" => 1,
                "status" => 200
            ],
        200);
    }

    public function get_favourites() {
        $favorites = Favorite::where('member_id', Auth::id())->get();
        return response()->json(
            [
                "success" => true,
                "message" => "",
                "data" => FavoritesResource::collection($favorites),
                "total" => count($favorites),
                "status" => 200
            ],
        200);
    }

    public function delete_favorite($id){
        $favorites = Favorite::where('member_id', Auth::id())
        ->where('id', $id)
        ->firstOrFail();

        $favorites->delete();
        return response()->json(
            [
                "success" => true,
                "message" => 'Package has been successfully removed from favorites list.',
                "status" => 200,
            ], 200
        );
    }

    public function get_enquiries() {
        $enquiries = Enquiry::where('member_id', Auth::id())->get();

        return response()->json(
            [
                "success" => true,
                "message" => "",
                "data" => EnquiriesResource::collection($enquiries),
                "total" => count($enquiries),
                "status" => 200
            ],
        200);
    }

    public function delete_enquiry($id){
        $enquiry = Enquiry::where('member_id', Auth::id())
        ->where('id', $id)
        ->firstOrFail();

        $enquiry->delete();
        return response()->json(
            [
                "success" => true,
                "message" => 'Enquiry has been successfully removed from the list.',
                "status" => 200,
            ], 200
        );
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


    // forget password functionality
    public function forgotPassword(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
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
        

        $user = Member::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = Str::random(60);
        DB::table('password_resets')->where('email', $user->email)->update(['token' => $token]);
        Mail::send('emails.reset-password', ['token' => $token, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email)->subject('Reset Password');
        });

        return response()->json(['message' => 'Password reset email sent']);
    }
}
