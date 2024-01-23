<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BloodSearch;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class BloodController extends Controller
{
    public function index(){
        SEOMeta::setRobots('index, follow');
        OpenGraph::addProperty('type', 'website');
        JsonLd::setType('website');
        SEOTools::setTitle('Blood BD');
        SEOTools::setDescription('Blood BD !!!');
        SEOMeta::addKeyword('Blood');
       SEOTools::opengraph()->setUrl(url('/'));
       
  return view("frontend.welcome");
    }
    public function search()
    {
              SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle('Blood BD Search');
              SEOTools::setDescription('Blood BD Search');
              SEOMeta::addKeyword('Staritltd');
             SEOTools::opengraph()->setUrl(url('/'));
             return view("frontend.blood.search");
    }
    public function searchBlood(Request $request)
    {
        $this->validate($request, [
            'blood_group' => 'required',
            'amount_bag' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
           
            ]);
           
        $blood=new BloodSearch();
        $blood->user_id=Auth::id();
        $union=$request->union;
        $upazila=$request->upazila;
        $district=$request->district;
        $blood->blood_group=$request->blood_group;
        $blood->amount_bag=$request->amount_bag;
        $blood->division=$request->division;
        $blood->district=$district;
        $blood->upazila=$request->upazila;
        $blood->upazila=$upazila;
        $blood->union=$union;
        $blood->created_by_user_id=Auth::id();
        $blood->updated_by_user_id=Auth::id();
        $blood->save();
        if($blood){
           $bloodDonner= User::join('profiles','profiles.user_id','users.id')
           ->where('users.user_type','User')
           ->where('users.profile_visibility',1)
           ->where('profiles.blood_group',$request->blood_group)
           ->where('profiles.division',$request->division);
           if($district){
            $bloodDonner->where('profiles.district',$district);
           }
           if($upazila){
            $bloodDonner->where('profiles.upazila',$upazila);
           }
           if($union){
            $bloodDonner->where('profiles.union',$union);
           }
           $bloodDonners= $bloodDonner->get();
          return view("frontend.blood.search_result",compact('bloodDonners'));
        }
        else{
            Toastr::success("No Data Found", "Success");
            return back();
        }
       
           
    }
    public function bloodRequest()
    {
           SEOMeta::setRobots('index, follow');
              OpenGraph::addProperty('type', 'website');
              JsonLd::setType('website');
              SEOTools::setTitle('Blood BD Request');
              SEOTools::setDescription('Blood BD Request');
              SEOMeta::addKeyword('Staritltd');
             SEOTools::opengraph()->setUrl(url('/'));
             return view("frontend.blood.request");
    }
    public function bloodRequestStore(Request $request)
    {
        $this->validate($request, [
            'health_issue' => 'required',
            'patients_name' => 'required',
            'blood_group' => 'required',
            'amount_bag' => 'required',
            'date' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'union' => 'required',
            'address' => 'required',
            ]);
        $blood=new BloodRequest();
        $blood->user_id=Auth::id();
        $blood->patients_name=$request->patients_name;
        $blood->blood_group=$request->blood_group;
        $blood->amount_bag=$request->amount_bag;
        $blood->date=$request->date;
        $blood->time=$request->time;
        $blood->health_issue=$request->health_issue;
        $blood->division=$request->division;
        $blood->district=$request->district;
        $blood->upazila=$request->upazila;
        $blood->union=$request->union;
        $blood->address=$request->address;
        $blood->contact_person_phone=$request->contact_person_phone;
        $blood->created_by_user_id=Auth::id();
        $blood->updated_by_user_id=Auth::id();
        $blood->save();
        Toastr::success("Address Update  Successfully", "Success");
        return back();
           
    }
  

    public function aboutUs(){
        return view("frontend.pages.about_us");
    }

   
}
