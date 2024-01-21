<?php
namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\ErrorTryCatch;
class UserController extends Controller
{
    public function profile(){
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Profile');
        SEOTools::setDescription('Profile Update');
        SEOMeta::addKeyword('Profile');
       SEOTools::opengraph()->setUrl(url('/'));
       $profile=User::join('profiles','profiles.user_id','users.id')->find(Auth::id());
       
  return view("frontend.user.profile",compact('profile'));
    }
    public function profileUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'profile_visibility' => 'required',
            'phone' => 'required|digits:11|unique:users,phone,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
           ]);

      
        $user=User::find(Auth::id());
        $user->name=$request->name;
        $user->profile_visibility=$request->profile_visibility;
        $user->email=$request->email;
        $user->phone=$request->phone;
       
        $user->save();
        if($user){
            $profile=Profile::whereuser_id(Auth::id())->first();
            $profile->blood_group= $request->blood_group;
            $profile->date_of_birth= $request->date_of_birth;
            $profile->gender= $request->gender;
            $profile->weight=$request->weight;
            $profile->division=$request->division;
            $profile->district=$request->district;
            $profile->upazila=$request->upazila;
            $profile->union=$request->union;
            $profile->address=$request->address;
            $profile->save();
        }
        Toastr::success("Profile Update  Successfully", "Success");
        return back();
       
      
    }

    public function aboutUs(){
        return view("frontend.pages.about_us");
    }

   
}
