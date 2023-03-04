<?php
namespace App\Http\Controllers\Common;
use DB;
use File;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Sohibd\Laravelslug\Generate;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $profile=User::with('profile')->find(Auth::id());
        return view('backend.common.profiles.index')->with('profileInfo',$profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfileForm()
    {
        $user= User::join('profiles', 'profiles.user_id', '=', 'users.id')->select('users.*','profiles.gender','profiles.position','profiles.fax','profiles.country','profiles.state','profiles.office_phone','profiles.company_name','profiles.company_address','profiles.google_location_link','profiles.facebook_link','profiles.twitter_link','profiles.linkedin_link','profiles.facts','profiles.company_logo','profiles.description')->findOrFail(Auth::id());
        if($user->user_type=='Company'){
            return view('backend.common.profiles.update_company_profile')->with('user',$user); 
        }
        else{
            $profile=User::with('profile')->find(Auth::id());
            return view('backend.common.profiles.index')->with('profileInfo',$profile); 
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCompanyProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id,
             'username' => 'required|unique:users,username,'.Auth::id(),
            // 'phone' => 'required|min:9|max:60',
            'fax' => 'required|min:9|max:60',
            'gender' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'company_name' => 'required',
         
        ]);
                
                $user = User::find(Auth::id());
                $name = $request->name;
                $user->name=$name;
                $user->user_type='Company';
                // $user->email=$request->email;
                // $user->email_verified_at=now();
                // $user->phone=$request->phone;
                $user->username= Generate::Slug($request->username);
                $user->zip_code = $request->zip_code;
                $user->ip_address = $request->ip();
                if(!empty($request->password)){
                    $this->validate($request, [
                        'password' => 'required|min:6|max:40',
        
                    ]);
                 $user->password = Hash::make($request->password);
                }
                if ($request->hasFile('image')) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
    
                    ]);
                    Storage::delete(@$user->image);
                    $user->image = ($request->image->store('uploads/company/user'));
                }
               
                $user->updated_by_user_id =  Auth::id();
                if ($user->save()) {
                    $profile = Profile::whereuser_id($user->id)->first();
                    $profile->user_id = $user->id;
                    $profile->position = $request->position;
                    $profile->gender = $request->gender;
                    $profile->fax = $request->fax;
                    $profile->country = $request->country;
                    $profile->state = $request->state;
                    $profile->company_address = $request->company_address;
                    $profile->company_name = $request->company_name;
                    $profile->google_location_link = $request->google_location_link;
                    $profile->facebook_link = $request->facebook_link;
                    $profile->twitter_link = $request->twitter_link;
                    $profile->linkedin_link = $request->linkedin_link;
                    $profile->facts = $request->facts;
                    $profile->description = $request->description;
                    if ($request->hasFile('company_logo')) {
                        $this->validate($request, [
                            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        
                        ]);
                        Storage::delete($profile->company_logo);
                        $profile->company_logo = ($request->company_logo->store('uploads/company/logo'));
                    }
        
                    $profile->save();
                    Toastr::success("Company Update Successfully", "Success");
                    return redirect()->route(request()->segment(1) . '.profiles.index');
        
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
