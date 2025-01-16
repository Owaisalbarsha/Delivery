<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use App\Services\TwilioService;
use App\Notifications\LoginNotification;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            "phone_number"=>'required|unique:users,phone_number|regex:/^09[0-9]{8}$/',
            "password"=>'required|min:8|max:64',
            //"role" => 'required',
            //"name"=>'required|regex:/^[a-zA-Z ]{3,64}$/',
            //"email" => 'required',
            //"image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails())
            return response()->json([
                "Response Message" => __('auth.Invalid Credentials'),
                "Errors" => $validator->errors()
            ] , 400);

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Phone Number Verification

        // $phoneNumber = $validatedData['phone_number'];
        // $this->twilioService->sendOtp($phoneNumber);
        // $code = $request->input('code');
        // $isValid = $this->twilioService->verifyOtp($phoneNumber, $code);
        // if ($isValid) {
        //     return response()->json(['message' => 'User verified']);
        // } else {
        //     return response()->json(['message' => 'Invalid code'], 400);
        // }

        // Image Handling:

        // if ($request->hasFile('image'))
        // {
        //     $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        //     $path = $request->file('image')->storeAs('images', $fileName, 'public');
        //     $validatedData["image"] = '/storage/' . $path;
        // }

        $user = User::create($validatedData);
        $token = $user->createToken('accessToken')->plainTextToken;
        return response()->json([
            "Response Message" => $user->name . __('auth.Signed Up Successfully'),
            "User" => $user,
            "Token" => $token,
        ],200);
    }
    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            "phone_number"=>'required|regex:/^09[0-9]{8}$/',

            "password"=>'required'
        ]);
        if($validator->fails())
            return response()->json([
                "Response Message" =>__('auth.Invalid Credentials'),
                "Errors" => $validator->errors()
            ] , 400);
        $validatedData = $validator->validated();
        $user = User::where('phone_number',$validatedData['phone_number'])->first();
        if(!$user || !Hash::check($validatedData['password'], $user->password))
            return response()->json([
                "Response Message" => __('auth.Wrong Password Or Phone Number')
            ],400);
            $token = $user->createToken('accessToken')->plainTextToken;

            return response()->json([
                "Response Message" => $user->name . __('auth.Signed In Successfully'),
                "User" => $user,
                "Token" => $token
            ] , 200);
    }
    public function logout()
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->tokens()->delete();
        return response()->json([
            "Response Message" => $user->name . " Signed Off Successfully"
        ], 200);
    }
    public function personal_information(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "first_name" => 'nullable|regex:/^[a-zA-Z\s\'-]{1,30}$/',
            "last_name"  => 'nullable|regex:/^[a-zA-Z\s\'-]{1,30}$/',
            "location"   => 'nullable|regex:/^[a-zA-Z0-9\s,.-]{1,100}$/',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validate->fails()) {
            return response()->json([
                "Response Message" => "Validation Failed",
                "Errors" => $validate->errors()
            ], 400);
        }

        $validatedData = $validate->validated();

        $user = auth('api')->user();

        if (isset($validatedData['first_name'])) {
            $user->first_name = $validatedData['first_name'];
        }
        if (isset($validatedData['last_name'])) {
            $user->last_name = $validatedData['last_name'];
        }
        if (isset($validatedData['location'])) {
            $user->location = $validatedData['location'];
        }

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $user->image = '/storage/' . $path;
        }

        $user->save();

        return response()->json([
            "Message" => "Updated successfully",
            "User" => $user,
        ], 200);
    }
    function me() {
        $user = auth('api')->user();
        if($user->image != null)
            $user->image = asset('storage/images/' . basename($user->image));

        return response()->json([
            "Response Message" => "Profile Data Received Successfully",
            "User"=>$user
        ] , 200);
    }
}
