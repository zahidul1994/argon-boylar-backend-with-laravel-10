<?php

namespace App\Http\Controllers\Api\Auth;
use  App\Models\User;
use App\Helpers\Helper;
use App\Models\Profile;
use App\Mail\UserOtpMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout', 'frontLogin', 'frontLoginOtpCheck']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithTokenNew(auth()->refresh());
    }
    protected function respondWithTokenNew($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

        $collection = collect([
            'id' => auth()->id(),
            'name' => auth()->user()->name,
            'user_type' => auth()->user()->user_type,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'image' => auth()->user()->image,
            'status' => auth()->user()->status,
            'otp' => auth()->user()->otp,
            'role' => auth()->user()->user_type,
        ]);
        $userInfo =  $collection->all();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $userInfo,
            'message' => "welcome " . auth()->user()->name,
            'expires_in' => auth()->factory()->getTTL() * 6000 * 2400 * 7000
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|min:6|max:30',
            'newPassword' => 'required|min:6|max:30',
            'confirmNewPassword' => 'required|same:newPassword',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        if (!Hash::check($request->currentPassword, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'errors' => ['Current password wrong']
            ]);
        } else {

            $userInfo = User::find(Auth::user()->id);
            $userInfo->password = Hash::make($request->confirmNewPassword);
            $userInfo->save();
        }
        if ($userInfo) {
            return response()->json([
                'success' => true,
                'message' => 'Password Change'
            ], 201);
        }
    }
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:130',
            'email' => 'required|min:3|max:130|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|min:9|max:30|unique:users,phone,' . Auth::id(),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }

        $userInfo = User::find(Auth::user()->id);
        $userInfo->name = $request->name;
        $userInfo->email = $request->email;
        $userInfo->phone = $request->phone;
        if ($request->filled('image')) {
            $rand = uniqid(Helper::make_slug(Str::limit($request->name, 30)));
            $name = $rand . '.webp';
            $image = Image::make($request->image)->encode('webp');
            Storage::disk('s3')->put('uploads/userphoto/' . $name, $image->getEncoded());
            $userInfo->image = Storage::disk('s3')->url('uploads/userphoto/' . $name);
        }

        $userInfo->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile Update'
        ], 201);
    }
    public function studentUpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:130',
            'email' => 'required|min:3|max:130|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|min:9|max:30|unique:users,phone,' . Auth::id(),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ]);
        }

        $userInfo = User::find(Auth::user()->id);
        $userInfo->name = $request->name;
        $userInfo->email = $request->email;
        $userInfo->phone = $request->phone;
        if ($request->filled('image')) {
            $rand = uniqid(Helper::make_slug(Str::limit($request->name, 30)));
            $name = $rand . '.webp';
            $image = Image::make($request->image)->encode('webp');
            Storage::disk('s3')->put('uploads/userphoto/' . $name, $image->getEncoded());
            $userInfo->image = Storage::disk('s3')->url('uploads/userphoto/' . $name);
        }

        $userInfo->save();

        if ($userInfo) {
            $profile = Profile::whereuser_id($userInfo->id)->first();
            $profile->level = $request->level;
            $profile->address = $request->address;
            $profile->gender = $request->gender;
            $profile->country = $request->country;
            $profile->division = $request->division;
            $profile->district = $request->district;
            $profile->thana = $request->thana;
            $profile->class_id = $request->class_id;
            $profile->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Profile Update'
        ], 201);
    }


    public function frontLogin(Request $request)
    {
        
        $checkPhone = User::wherephone($request->phoneormail)->first();
       
        if ($checkPhone) {
            $checkPhone->otp = 123456;
            // $checkPhone->otp = rand(100000, 999999);
            $checkPhone->save();
            $text = 'Hi,' . $checkPhone->otp . 'is your verification code. ' . env('APP_NAME');
            Helper::sendSMS($text, $checkPhone->phone);
            return response()->json([
                'success' => true,
                'message' => 'Check Your Phone to get Otp'
            ]);
        }
        $checkEmail = User::whereemail($request->phoneormail)->first();
        if ($checkEmail) {
            $checkEmail->otp = 123456;
            $data = [
                'name' => 'User',
                'email' => $checkEmail['email'],
                'subject' => 'OTP Verify Mail',
                'message' => 'Hi,' . $checkEmail->otp . 'is your verification code. ' . env('APP_NAME')
            ];

            Mail::to($checkEmail->email)->send(new UserOtpMail($data));
            return response()->json([
                'success' => true,
                'message' => 'Check Your Email to get Otp'
            ]);
        } else {
            $mailCheck = explode('@',  $request->phoneormail)[1] ?? null;
            if (!$mailCheck) {
                $email = $request->phoneormail . '@webmail.com';
                $phone = $request->phoneormail;
            } else {
                $email = $request->phoneormail;
                 $phone = rand(10000000000, 99999900000);
            }
            $userInfo = new User();
            $userInfo->name = 'Register User';
            $userInfo->email = $email;
            $userInfo->user_type = 'Student';
            $userInfo->phone = $phone;
            $userInfo->password = Hash::make($phone);
            $userInfo->image =  Helper::customImageAsset();
            $userInfo->save();
            $userInfo->assignRole('Student');
            $profile = new Profile();
            $profile->user_id= $userInfo->id;
            $profile->gender = "Male";
            $profile->country = "Bangladesh";
            $profile->save();
            return  $this->frontLogin($request);
        }
    }
    public function frontLoginOtpCheck(Request $request)
    {
        $checkPhone = User::wherephone($request->phoneormail)->whereotp((int)$request->code)->first();
        if ($checkPhone) {
            $checkPhone->otp = NULL;
            $checkPhone->save();
            $user = User::find($checkPhone->id);
            $token = Auth::login($user);
            return $this->respondWithToken($token);
        }
        $checkEmail = User::whereemail($request->phoneormail)->whereotp((int)$request->code)->first();
        if ($checkEmail) {
            $checkEmail->otp = NULL;
            $checkEmail->save();
            $user = User::find($checkEmail->id);
            $token = Auth::login($user);
            return  $this->respondWithToken($token);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Otp Verify Fail'
            ]);
        }
    }
}
