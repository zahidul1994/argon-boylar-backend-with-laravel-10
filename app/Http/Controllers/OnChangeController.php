<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Traits\LocationTrait;
use App\Models\District;
use App\Models\Division;

class OnChangeController extends Controller
{
    use LocationTrait;
    public function getDistrict($id){
        $districtId=Division::wheredivision($id)->first();
        if($districtId){
          $district=  $this->findDistrict($districtId->id);
          return response($district);
        }else{
            $district=  [];
            return response($district);
        }
       
    }
    public function getThana($id){
        $districtId=District::wheredistrict($id)->first();
        if($districtId){
          $district=  $this->findThana($districtId->id);
          return response($district);
        }else{
            $district= [];
            return response($district);
        }
       
    }

   
}
