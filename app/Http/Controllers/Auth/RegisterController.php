<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric','digits:11', 'unique:users'],
			 'password' => ['required', 'string', 'min:6'],
           
        ]);
    }

   
    protected function create(array $data)
    {
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['phone'].'@gmail.com',
            'phone' => $data['phone'],
            'user_type' => "User",
            'image' => "not-found.webp",
            'otp' => mt_rand('0000','9999'),
            'username'=> Generate::Slug($data['name'].date('Y-m-d').$data['phone']),
           'password' => Hash::make($data['password']),
        ]);
        $profile=new Profile();
        $profile->user_id= $user->id;
        $profile->blood_group= $data['blood_group'];
        $profile->date_of_birth= $data['date_of_birth'];
        $profile->gender= $data['gender'];
        $profile->position='Blood Hero';
        $profile->weight=$data['weight'];
        $profile->division=$data['division'];
        $profile->district=$data['district'];
        $profile->upazila=$data['thana'];
        $profile->union=$data['union'];
        $profile->address=$data['address'];
        $profile->save();
        return $user;
    }


 
}
