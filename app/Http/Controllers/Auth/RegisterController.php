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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'min:8','max:68', 'unique:users'],
            'zipcode' => ['required', 'min:4','max:30'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

   
    protected function create(array $data)
    {
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'user_type' => "Customer",
            'language' => json_encode(["en"]),
            'image' => "not-found.webp",
            'username'=> Generate::Slug($data['name'].date('Y-m-d').$data['phone']),
            'zip_code' =>  $data['zipcode'],
            'password' => Hash::make($data['password']),
        ]);
        $profile=new Profile();
        $profile->user_id= $user->id;
        $profile->gender= 'Male';
        $profile->save();
        return $user;
    }


    public function companyRegister(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:9|max:60|unique:users,phone',
            'password' => 'required|min:6|max:40|confirmed',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'zip_code' => 'required|min:4|max:60',
            'company_name' => 'required|min:1|max:198',
           
        ], [
            'zip_code.required' => "The Zip Code name field is required",
            'zip_code.min' => "The  Zip Code Minimum Length 4",
            'zip_code.max' => "The  Zip Code Maximum Length 60",
            'company_name.required' => "The Company name field is required",
            'company_name.min' => "The  Company name Minimum Length 1",
            'company_name.max' => "The Company Maximum Length 198",
            'company_logo.required' => "The Company Logo  field is required",

        ]);

        $name = $request->name;
        $password = Hash::make($request->password);
        $user = new User();
        $user->name=$name;
        $user->user_type='Company';
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->username= Generate::Slug($name.date('Y-m-d').$request->company_name);
        $user->image = 'not-found.webp';
        $user->zip_code = $request->zip_code;
        $user->ip_address = $request->ip();
        $user->password =  $password;
        $user->created_by_user_id = 1;
        $user->updated_by_user_id =  1;
        if($user->save()){
         $profile=new Profile();
         $profile->user_id= $user->id;
         $profile->company_name= $request->company_name;
         $profile->company_logo= $request->company_logo->store('uploads/company/logo');
        }
        $user->assignRole('Company');
        $profile->save();
        Auth::login($user);
        Toastr::success("Company Account Create Successfully", "Success");
       return redirect()->to('company/dashboard');
    }
}
